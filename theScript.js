window.onload = function()
{
	updateWidth();
	chart = document.getElementById("myChart");
	var ctx = chart.getContext("2d");
	var data = {
	    labels: ["A+", "A", "A-", "B+", "B", "B-", "C+", "C", "C-", "D+", "D", "D-", "F"],
	    datasets: 
	    	[{
	            label: "My First dataset",
	            fillColor: "rgba(0,85,186,0.5)",
	            strokeColor: "rgba(220,220,220,0.8)",
	            highlightFill: "rgba(0,165,229,0.75)",
	            highlightStroke: "rgba(220,220,220,1)",
	            data: [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 100]
	        }]
		}
	myNewChart = new Chart(ctx).Bar(data, {barShowStroke: false});
}


$(document).ready(function() {
	$('#class').selectpicker('hide');
	$('#professor').selectpicker('hide');
	$('#quarter').selectpicker('hide');

	$.post("php/getSubjects.php",
	    function (data) 
        {
         	$('#subject').html(data);
         	$('#subject').selectpicker('refresh');
        }
	);

});


$('#subject').on('change', function(){
    
    $.post("php/getClasses.php", 
		{
			 subject: $(this).val()
		},
	    function (data) 
        {
         	$('#class').html(data);
         	$('#class').selectpicker('refresh');
         	$('#class').selectpicker('show');
        }
	);
	$('#professor').selectpicker('hide');
	$('#quarter').selectpicker('hide');
});

$('#class').on('change', function(){
    
    $.post("php/getProfessors.php", 
		{
			 subject: $('#subject').val(),
			 theclass: $(this).val()
		},
	    function (data) 
	    {
	     	$('#professor').html(data);
	     	$('#professor').selectpicker('refresh');
	     	$('#professor').selectpicker('show');
	    }
	);
	$('#quarter').selectpicker('hide');

});


$('#professor').on('change', function(){
    
    $.post("php/getQuarters.php", 
	{
		 professor: $(this).val(),
		 subject: $('#subject').val(),
		 theclass: $('#class').val()
	},
    function (data) 
    {
     	$('#quarter').html(data);
     	$('#quarter').selectpicker('refresh');
     	$('#quarter').selectpicker('show');
    });

});

$('#quarter').on('change', function(){

	$.post("php/getGrades.php", 
	{
		quarter: $(this).val(),
	    professor: $('#professor').val(),
	    subject: $('#subject').val(),
	    theclass: $('#class').val()
	},
    function (data) 
    {
    	var gradesArray = data.split(",");
 		for(var i = 0 ; i < 13; i++)
		{
			myNewChart.datasets[0].bars[i].value = gradesArray[i];
		}
		myNewChart.update();
		temp = $('#subject').selectpicker('val') + " " + $('#class').selectpicker('val') + " with " + $('#professor').selectpicker('val') + " during " + $('#quarter').selectpicker('val');
		$('#displayName').text(temp);
    });
});


function updateWidth()
{
	var canvas = document.getElementById("myChart");
	if(window.innerWidth < 500)
	{
		canvas.height = window.innerHeight*1/2;
		canvas.width  = window.innerWidth*9/10;
	}
	else{
		canvas.width  = window.innerWidth*3/5;
		canvas.height = window.innerHeight*2/3;
	}
}

