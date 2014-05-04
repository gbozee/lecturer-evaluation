var services = angular.module('app');

services.factory('LQuestionnaires',function(){
    function LQuestionnaires(response){
        _.extend(this,response);
    }
    LQuestionnaires.prototype={
        answered:function(){
            var i;
            for(i=0;i<this.answers.length;i++){
                if(!this.answers[i].answer){
                    this.completed =  false;
                }
            }
            return this.completed;
        }
    };
})
services.factory('Questions',function(serverInfo,Answers){

    function QuestionsWithAnswers(lecturer,course){
        this.lecturer = lecturer;
        this.course = course;
        var answers = new Answers(serverInfo.questionnaire.questions);
        this.answers = answers.answers;
    }

    QuestionsWithAnswers.prototype={
        completed:function(){
            var i,completed = true;
            for(i=0;i<this.answers.length;i++){
                if(!this.answers[i].answer){
                    completed = false;
                }
            }
            return completed;
        }
    };

    return (QuestionsWithAnswers);
});

services.factory('Answers',function(){
    function Answers(questions){
        this.answers = populate(questions);
    }
    function populate(questions){
        var result = [];
        angular.forEach(questions,function(q){
            result.push({question_id: q.id,answer:null,answered:answered,score:0});
        });
        return result;
    }
    function answered(){
        return this.answer?true:false
    }

    return (Answers);
});

services.factory('Courses',function(){
    function Courses(courses,q_results){
        angular.forEach(courses,function(course){
            _.extend(course,{completed:false});
            angular.forEach(course.lecturers,function(l){
                hasFilled(l,q_results);
            })
        });
        _.extend(this,courses);
        this.courses =courses;
    }
    function hasFilled(lecturer,q_results){
        var index = _.findIndex(q_results,{lecturer_id:lecturer.id});
        lecturer.completed = index > -1;
    }
    return (Courses);
});



services.factory('ServerResult',function($http,$q,serverInfo){
    return{
        response:function(){
            return $http.get('/serverInfo/'+serverInfo.user.id);
        },
        questionnaires:function(){
            return $http.get('/questionnaire-details/'+serverInfo.user.id);
        },
        result:function(){
            return $http.get('/questionnaire_result/'+serverInfo.user.id);
        },
        UnRegisterCourse:function(user,course){
            return $http.get('/users/' + user.id + '/unregister/' + course.id);
        },
        RegisterCourse:function(user,course){
            return $http.get('/users/' + user.id + '/register/' + course.id);
        },
        SaveQuestionnaire:function(result){
            return $http.post('/saveResult/' + result.id, result);
        }
    }
});

