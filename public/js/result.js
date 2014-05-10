var app = angular.module('result', ['ngRoute', 'ngResource', 'ui.bootstrap','chartjs-directive']);

app.factory('datacontext',function($q){
		console.log(LEResults);
	var labels = function(array){
        var result = [];
        var data = [];
        angular.forEach(array,function(ar){
            result.push(ar.name);
            data.push(Number(ar.score));
        });
        return {labels:result,data:data};
    };


	return{
		lecturersWithResult:function(){
			var d = $q.defer();
	         d.resolve(labels(LEResults));
	         return d.promise;
	     }
	}
		 
	
});

app.controller('ResultCtrl', function ($scope,datacontext) {

    datacontext.lecturersWithResult().then(function(result){
        var data = {
            labels:result.labels,
            datasets:[{
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : result.data
            }]
        };
        var options = {
            scaleOverlay : false,

            //Boolean - If we want to override with a hard coded scale
            scaleOverride : false,

            //** Required if scaleOverride is true **
            //Number - The number of steps in a hard coded scale
            scaleSteps : null,
            //Number - The value jump in the hard coded scale
            scaleStepWidth : null,
            //Number - The scale starting value
            scaleStartValue : null,

            //String - Colour of the scale line
            scaleLineColor : "rgba(0,0,0,.1)",

            //Number - Pixel width of the scale line
            scaleLineWidth : 1,

            //Boolean - Whether to show labels on the scale
            scaleShowLabels : true,

            //Interpolated JS string - can access value
            scaleLabel : "<%=value%>",

            //String - Scale label font declaration for the scale label
            scaleFontFamily : "'Arial'",

            //Number - Scale label font size in pixels
            scaleFontSize : 12,

            //String - Scale label font weight style
            scaleFontStyle : "normal",

            //String - Scale label font colour
            scaleFontColor : "#666",

            ///Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines : true,

            //String - Colour of the grid lines
            scaleGridLineColor : "rgba(0,0,0,.05)",

            //Number - Width of the grid lines
            scaleGridLineWidth : 1,

            //Boolean - If there is a stroke on each bar
            barShowStroke : true,

            //Number - Pixel width of the bar stroke
            barStrokeWidth : 2,

            //Number - Spacing between each of the X value sets
            barValueSpacing : 10,

            //Number - Spacing between data sets within X values
            barDatasetSpacing : 1,

            //Boolean - Whether to animate the chart
            animation : true,

            //Number - Number of animation steps
            animationSteps : 60,

            //String - Animation easing effect
            animationEasing : "easeOutQuart",

            //Function - Fires when the animation is complete
            onAnimationComplete : null

        };
        $scope.myChart = {"data": data, "options": options };
    });
	datacontext.lecturersWithResult().then(function(result){
        var data = {
            labels:result.labels,
            datasets:[{
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : result.data
            }]
        };
        var options = {
            scaleOverlay : false,

            //Boolean - If we want to override with a hard coded scale
            scaleOverride : false,

            //** Required if scaleOverride is true **
            //Number - The number of steps in a hard coded scale
            scaleSteps : null,
            //Number - The value jump in the hard coded scale
            scaleStepWidth : null,
            //Number - The scale starting value
            scaleStartValue : null,

            //String - Colour of the scale line
            scaleLineColor : "rgba(0,0,0,.1)",

            //Number - Pixel width of the scale line
            scaleLineWidth : 1,

            //Boolean - Whether to show labels on the scale
            scaleShowLabels : true,

            //Interpolated JS string - can access value
            scaleLabel : "<%=value%>",

            //String - Scale label font declaration for the scale label
            scaleFontFamily : "'Arial'",

            //Number - Scale label font size in pixels
            scaleFontSize : 12,

            //String - Scale label font weight style
            scaleFontStyle : "normal",

            //String - Scale label font colour
            scaleFontColor : "#666",

            ///Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines : true,

            //String - Colour of the grid lines
            scaleGridLineColor : "rgba(0,0,0,.05)",

            //Number - Width of the grid lines
            scaleGridLineWidth : 1,

            //Boolean - If there is a stroke on each bar
            barShowStroke : true,

            //Number - Pixel width of the bar stroke
            barStrokeWidth : 2,

            //Number - Spacing between each of the X value sets
            barValueSpacing : 10,

            //Number - Spacing between data sets within X values
            barDatasetSpacing : 1,

            //Boolean - Whether to animate the chart
            animation : true,

            //Number - Number of animation steps
            animationSteps : 60,

            //String - Animation easing effect
            animationEasing : "easeOutQuart",

            //Function - Fires when the animation is complete
            onAnimationComplete : null

        };
        $scope.myChart = {"data": data, "options": options };
    });

});
