    // DISPLAY THE PREVIOUS CAREER RESULT ON THE previous-result.html ONCE THE PAGE LOADS
        // add an id (#previous-test) the to previous result page
        if(_$('.question-box'))
        _$('.question-box').addEventListener('DOMContentLoaded', function () {
            // Assign the previous
            var careerInterest = localStorage.TAMCareerInterest.split(",");
            preparedResultBoard(careerInterest);     
        });

      
   