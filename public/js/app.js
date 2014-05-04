var app = angular.module('app', ['ngRoute', 'ngResource', 'ui.bootstrap','chartjs-directive']);

app.value('serverInfo', $SERVER_INFO);
app.value('toastr', toastr);
app.factory('notifier', function (toastr) {
    return {
        notify: function (msg) {
            toastr.success(msg);
            console.log(msg);
        }  }
});
//app.run(function($rootScope,$http){
//    $http.get('/serverInfo/'+$SERVER_INFO.user.user.id).success(function(data){
//        $rootScope.response = data;
//    });
//})

app.config(function ($routeProvider) {
    $routeProvider.when('/', {templateUrl: '/partials/home.html', controller: 'HomeCtrl'})
        .when('/registration', {templateUrl: '/partials/registration.html', controller: 'CourseRegCtrl'})
        .when('/questionnaire', {templateUrl: '/partials/questionnaire.html', controller: 'QuestionnaireCtrl'})
        .when('/results', {templateUrl: '/partials/results.html', controller: 'ResultCtrl'})
});

app.controller('CourseRegCtrl', function ($scope, datacontext, notifier) {
    datacontext.catalog().then(function(data){
        console.log(data);
       $scope.catalog = data;
    });


    $scope.registerCourse = function (course) {
        console.log(course);
        datacontext.register(course).then(function () {
            notifier.notify("Success");
            course.registered = true;
        });
    };


    $scope.unregisterCourse = function (course) {
        datacontext.unregister(course).then(function () {
            course.registered = false;
            notifier.notify("Success");
        });
    }


});
app.controller('HomeCtrl', function ($scope,$filter,datacontext) {
    function initialize(){
        datacontext.questionnaires().then(function(data){
            $scope.questionnaires = data;
            $scope.f_questionnaires = $filter('filter')($scope.questionnaires, {completed:false});
            console.log($scope.questionnaires);
        });
    }
    initialize();
});

app.controller('QuestionnaireCtrl', function ($scope,$filter,datacontext, Courses) {
    var x =function (){
        var i,completed = true;
        for(i=0;i<this.answers.length;i++){
            if(!this.answers[i].answer){
                completed =  false;
            }
        }
        return completed;
    }

    function extendQ(array){
        angular.forEach(array,function(val){
            _.extend(val,{answered:x});
        })
        return array;
    }
    function initialize(){
        datacontext.questionnaires().then(function(data){
            $scope.questionnaires = extendQ(data);
            $scope.FilteredQuestionnaires = $filter('filter')($scope.questionnaires, {completed:false});
            console.log($scope.questionnaires);
            $scope.lecturerQ = $scope.FilteredQuestionnaires[0];
        });
    }
    initialize();
    datacontext.response().then(function(data){
        console.log(data);
        $scope.user = data.user;
        $scope.questionnaire = data.questionnaire;
    });
    $scope.option = datacontext.opinion;

    $scope.onSelected = function (temp) {
        if(!isNaN(temp.score)){
            temp.answer = temp.score;
        }
        console.log(temp)
    };
    $scope.submit = function (lecturer) {
        console.log(lecturer);
        datacontext.saveQuestionnaire(lecturer).then(function () {
            initialize();
        })
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

});

app.service('datacontext', function (ServerResult, $q, $http,serverInfo) {
    var catalog = [];
    var user = {};
    var questionnaires = {};
    var questionnaire = {};
    var my_courses = {};
    var assesment = [
        {text: "Excellent", value: 5},
        {text: "Very Good", value: 4},
        {text: "Good", value: 3},
        {text: "Fair", value: 2},
        {text: "Poor", value: 1}
    ];
    var opinion = [
        {text: "Strongly Agree", value: 5},
        {text: "Moderately Agree", value: 4},
        {text: "Moderately Disagree", value: 3},
        {text: "Strongly Disagree", value: 2},
        {text: "No Comment", value: 1},
        {text: "Not Applicable", value: 0}
    ];
    var deferred = $q.defer();
    var received = false;
    ServerResult.response().success(function (data) {
        console.log(data);
        catalog = data.courses;
        user = data.user;
        my_courses = user.courses;
        questionnaire = data.questionnaire;
        filterCourses(my_courses);
        received = true;
    });





    function filterCourses(cc) {
        angular.forEach(catalog, function (course) {
            if (_.findIndex(cc, { 'code': course.code }) > -1) {
                _.extend(course, {registered: true});
            } else {
                _.extend(course, {registered: false});
            }
        });
        return catalog;
    }

    function CourseRegistration(course, flag) {
        var index = _.findIndex(catalog, {code: course.code});
        if (index > -1) {
            catalog[index].registered = flag;
        }

    }

    function getFilteredCourses(original) {
        var new_courses = [];
        angular.forEach(original, function (c) {
            if (c.registered === true) {
                new_courses.push(c);
            }
        });
        return new_courses;
    }

    function getUser() {
        $http.get('/serverInfo/' + user.id).success(function (data) {
            console.log(data);
            my_courses = data.courses;
            deferred.resolve(my_courses);
        });
        return deferred.promise;
    }

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
        questionnaire: function () {
            return questionnaire
        },
        user: function () {
            var d = $q.defer();
            ServerResult.response().then(function (data) {
                user = data.user;
                d.resolve(user);
            });
            return d.promise;
        },
        catalog: function () {
            var d = $q.defer();
            ServerResult.response().success(function (data) {
                catalog = data.courses;
                var result = filterCourses(data.user.courses);
                d.resolve(result);
            });
            return d.promise;
//            return catalog;
        },
        response:function(){
            var d = $q.defer();
            ServerResult.response().success(function (data) {
                d.resolve({user:data.user,questionnaire:data.questionnaire
                });
            });
            return d.promise;
        },
        questionnaires:function(){
            var d = $q.defer();
            ServerResult.questionnaires().success(function(data){
                questionnaires = data;
                console.log(questionnaires);
                d.resolve(questionnaires);
            });
            return d.promise;
        },
        courses: function () {
            var d = $q.defer();
            ServerResult.response().then(function (data) {
                my_courses = data.user.courses;
                filterCourses(my_courses);
                var result = getFilteredCourses(catalog);
                d.resolve(result);
            });
            return d.promise;
        },
        register: function (course) {
            ServerResult.RegisterCourse(user,course).then(function () {
                console.log(catalog);
                deferred.resolve();
            });
            return deferred.promise;
        },
        unregister: function (course) {
            ServerResult.UnRegisterCourse(user,course).then(function () {
                deferred.resolve();
            });
            return deferred.promise;
        },
        opinion: {
            assessment: assesment,
            opinion: opinion},
        saveQuestionnaire:function(result) {
            result.completed = true;
            var d = $q.defer();
            ServerResult.SaveQuestionnaire(result).success(function (data) {
                console.log(data);
                d.resolve(data);
            });
            return d.promise;
        },
        lecturersWithResult:function(){
            var d = $q.defer();
            ServerResult.result().success(function(data){
                d.resolve(labels(data));
            });
            return d.promise;
        }
    }
});

