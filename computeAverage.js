$(document).ready(function()
	{
		$.post("php/getAverages.php",
	    function (data) 
	    {
         	$('#averageGrades').html(data);
         	$(".analysisText").css({'height':($(".table-striped").height() + 150 +'px')});
        }
    );
});