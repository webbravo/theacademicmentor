   
   
   var currentQuestion = 0;

// DECLARE THE INTERNAL DATA STRUCTURE
   var selectedActivity = {};

// THE DOCUMENT QUERY SELECTOR SET TO _$
   var _$ = function(el) {
        return document.querySelector(el);
   };


// AN HELPER FUNCTION THAT CONVERTS OBJECTS TO ARRAY
   var convertToArray = (array) => {
       return arr = Object.keys(array).map(function (key) {return array[key]; }); 
   };
 
   
   var getIndexOFTwoLargestNumber = function(array){
        var firstNumber = getIndexOf(1, array);
        var secondNumber = getIndexOf(2, array);
        return [firstNumber, secondNumber];
   }

   function getIndexOf(position, arrayOfValue) {
        var temp_arr2  = arrayOfValue.slice(0);
        var second_largest_value = temp_arr2.sort()[temp_arr2.length - position];
        var index_of_largest_value = arrayOfValue.indexOf(second_largest_value);
        // console.log(second_largest_value);
        return index_of_largest_value;
   }

// COMPUTE THE USER's CAREER INTEREST
   var getCareerInterest = (array) => {
        var a = [], b = [], prev;
        arr.sort();
        for (let i = 0; i < arr.length; i++) {
        if (arr[i] !== prev) {
            a.push(arr[i]);
            b.push(1);
        } else {
            b[b.length - 1]++;
        }
            prev = arr[i];
        }
        // GET THE LARGEST NUMBER FROM THE, NUMBER OF OCCURENCE ARRAY
        var result = getIndexOFTwoLargestNumber(b); // return array
        
        var firstOption  = a[result[0]];
        var secondOption = a[result[1]];
        
        return [firstOption, secondOption];
   };

// THE DOCUMENT QUERY SELECTOR SET TO _$
   var getHollandCode = function(num) {
    switch (num) {
        case 1: return "Conventional";
        case 2: return "Enterprising";
        case 3: return "Artistic";
        case 4: return "Realistic";
        case 5: return "Investigative";
        case 6: return "Social";
        default:  return null;
    }
   };

   var getCareerInterestMessage = function (ci) {
       switch (ci) {
          case 'Conventional': 
          return 'A person who like to work with data, have clerical or numerical ability, carry out tasks in  detail, or follow through on others’ instruction';
          case 'Social': 
          return 'A person who like to work with people to enlighten, inform, help, train, or cure them, or are skilled with words.';
          case 'Realistic': 
          return 'A person who have athletic ability, prefer to work with objects, machines, tools, plants or animals, or to be outdoors.';
          case 'Investigative': 
          return 'You are a person who can to observe, learn, investigate, analyze, evaluate, or solve problems. ';
          case 'Artistic': 
          return 'You are artistic, innovating, or intuitional abilities and like to work in unstructured situations using their imagination and creativity';
          case 'Enterprising': 
          return 'You like to work with people, influencing, persuading, leading or managing for organizational goals or economic gain. ';
          default : return null;
       }
   }
   
// PREPARE THE SCORE BOARD AND DISPLAY IT
   var preparedResultBoard = (careerInterest) => {
       // change the header
           if (careerInterest.length >= 1) {
                 var firstInt  = careerInterest[0];
                 var firstDes  = getCareerInterestMessage(careerInterest[0]);

                //  if (careerInterest[0]) {
                //     var firstInt  = careerInterest[0];
                //     var firstDes  = getCareerInterestMessage(careerInterest[0]);
                //  }else{
                //     var secondInt  = "No selection made";
                //     var secondDes  = "No selection made";
                //  }

                 if (careerInterest[1]) {
                    var secondInt  = careerInterest[1];
                    var secondDes  = getCareerInterestMessage(careerInterest[1]);
                 }else{
                    var secondInt  = "- - - - -";
                    var secondDes  = "No selection made";
                 }

                _$('.question-box').innerHTML = 
               `<p id="congrat" class="center green-text" style="font-size:2.68rem; font-weight: bold">Congratulation <i class="fa fa-check"></i> </p>
                <p class="center grey-text">
                    Thanks for taking the career test, from the few information your provided, we found out 
                    that you have the following career personality;
                </p><hr>
                <div class="options col m12 s12">
                    <p class="green white-text z-depth-1" id="career-option1" style="font-size:2.2rem; padding: 0px 10px; margin-bottom: 0px">
                        ${firstInt}
                    </p>
                    <p class="grey-text" id="career-option-txt1">
                        ${firstDes}
                    </p>
                    <div style="height: 20px;"></div>
                    <p class="purple white-text z-depth-1" id="career-option1" style="font-size:2.2rem; padding: 0px 10px; margin-bottom: 0px">
                        ${secondInt}
                    </p>
                    <p class="grey-text" id="career-option-txt1">
                        ${secondDes} 
                    </p>
                </div>
                <div class="footer">
                    <a href="field-of-study.php" class="btn btn-large green white-text">Check Career options<i class="fa fa-left right"></i></a>
                </div>`;
           }else{
                _$('.question-box').innerHTML = 
                `<p class="center green-text " style="font-size:2.68rem; font-weight: bold">Congratulation <i class="fa fa-check"></i> </p>
                <p class="center grey-text">
                    Thanks for taking the career test, from the few information your provided, we found out 
                    that you have the following career personality;
                </p><hr>
                <div class="options col m12 s12">
                    <p class="green white-text z-depth-1" id="career-option1" style="font-size:2.2rem; padding: 0px 10px; margin-bottom: 0px">
                       No Result Found
                    </p>
                    <p class="grey-text" id="career-option-txt1">
                        We could not get find your previous career test result, for one of two reason, it is likely you have not done the career test 
                        or Data cache is full, click the green button to continue.
                    </p>
                    <div style="height: 20px;"></div>
                    
                </div>
                <div class="footer">
                    <a href="index.php" class="btn btn-large green white-text">Goto home<i class="fa fa-left right"></i></a>
                </div>`;
            }
          
       
   }


// DATA STRUCTURE CONTROLLER
   var dataStructure = function (action, id, data) {
       if (action === 'add') {
           selectedActivity[id] = data;
        }else if(action === 'delete') {
           delete selectedActivity[id];
       }
   }    


// CREATE THE QUESTION OBJECT CONSTRUSTOR
   var Question = function (id, question, hollandCode) {
        this.id = id;        
        this.question = question;
        this.hollandCode = hollandCode;
   }


// Question array to loop through
   var questions = [

        [
            new Question(1, 'Filing letters and reports', 1),
            new Question(2, 'Talking to people at a party', 2),
            new Question(3, 'Going to concerts or listening to music', 3),
            new Question(4, 'wildlife biology', 4),
            new Question(5, 'Creating a project for a science fair', 5),
            new Question(6, 'Studying other people\'s culture', 6)
        ],

        [
            new Question(7, 'Keeping detailed records', 1),
            new Question(8, 'Working on a sales campaign', 2),
            new Question(9, 'Designing clothes', 3),
            new Question(10, 'Decorating rooms', 4),
            new Question(11, 'Doing puzzles or playing word games', 5),
            new Question(12, 'Going to church', 6)
        ],
        
        [
            new Question(13, 'Working “nine to five” ' , 1),
            new Question(14, 'Being elected class president', 2),
            new Question(15, 'Learning foreign languages', 3),
            new Question(16, 'Cooking', 4),
            new Question(17, 'Physics', 5),
            new Question(18, 'Attending sports events', 6)
        ],

            
        [
            new Question(19, 'Working with a budget and preparing financial reports” ' , 1),
            new Question(20, 'Selling new a product', 2),
            new Question(21, 'Playing music', 3),
            new Question(22, 'Putting together model kits or craft projects', 4),
            new Question(23, 'Working in a lab', 5),
            new Question(24, 'Helping people solve personal problems. ', 6)
        ],


        [
            new Question(25, 'Preparing “Word” documents' , 1),
            new Question(26, 'Talking to salespeople', 2),
            new Question(27, 'Acting in or helping to put on a play', 3),
            new Question(28, 'Working with animals', 4),
            new Question(29, 'Advanced math', 5),
            new Question(30, 'Helping the elderly', 6)
        ],

        [
            new Question(31, 'Using a cash register' , 1),
            new Question(32, 'Talking to groups or people', 2),
            new Question(33, 'Drawing or painting', 3),
            new Question(34, 'Building things from down up', 4),
            new Question(35, 'do research and analyse things', 5),
            new Question(36, 'Belonging to a club', 6)
        ],

        [
            new Question(37, 'use data processing equipment ' , 1),
            new Question(38, 'Leading group activities', 2),
            new Question(39, 'Reading art and/or music magazines', 3),
            new Question(40, 'Carpentry and other building projects', 4),
            new Question(41, 'perform lab experiments ', 5),
            new Question(42, 'Making new friends', 6)
        ],

        [
            new Question(43, 'Using office equipment' , 1),
            new Question(44, 'Buying clothes for a store', 2),
            new Question(45, 'Writing stories or poetry', 3),
            new Question(46, 'Fixing electrical appliances ', 4),
            new Question(47, 'Flying airplanes or learning about aircraft', 5),
            new Question(48, 'Teaching children', 6)
        ],

   ];


// Display question function
   var displayQuestions = function (counter) {
        // GET THE QUESTION CONTAINER DIV
        //alert(counter) 
        var questionLeftElement =  _$('.header').firstChild;
        var questionDiv = _$('.collection');
        questionDiv.innerHTML = "";
        for (let i = 0; i < questions[counter].length ; i++) {
            
            // console.log(questions[counter][i].question);
            var id = questions[counter][i].id;
            var qn = questions[counter][i].question;
            var hc = getHollandCode(questions[counter][i].hollandCode);            
            questionDiv.innerHTML += `<li id="${id}" style="cursor:pointer" data-hollandCode="${hc}" class="collection-item"><div> ${qn}<a href="#!" class="secondary-content"><i class="right fa"></i></a></div></li>`
        }
        // THE NUMBER  OF QUESTIONS LEFt
        questionLeftElement.textContent = 'Questions '+(counter + 1) +' of '+questions.length;
        //console.log('question '+(counter + 1) +' of '+questions.length);
        
        var questionLeftElement =  _$('.header').firstChild;
   };


// Display the Score board
   var displayScoreBoard = function () {
        // Get the top two career interest
           var careerInterest = getCareerInterest(convertToArray(selectedActivity));

        // save the top 2 career interest to localStorage
           localStorage.setItem('TAMCareerInterest', careerInterest);

        // Prepare the Display board in HTML
           preparedResultBoard(careerInterest);

           save();
             
   };  


// Load question once the page is loaded
   document.addEventListener('DOMContentLoaded', () => {displayQuestions(currentQuestion)});

//ADD AN EVENT LISTERNER TO THE NEXT BUTTON
   _$('#nextBtn').addEventListener('click', function () {
       currentQuestion += 1

       // Check if user a made any selection
          if (checkForValidUserSelection() === false) {
              alert('Select at least one activity, you enjoy doing');
          } else {
            // Check if the we at the last set of questions 
            if(currentQuestion >= questions.length){
                // Save the user selected activites to localStorage
                   
                // Display score
                   displayScoreBoard();
    
                // display career possibilities
                   
            }else{
                // Dispaly new set of questions 
                displayQuestions(currentQuestion);
            }
          }
   });


// CHECK IF THE USER HAS SELECTED ANY ACTIVITY AT ALL
   var checkForValidUserSelection = function () {
        return document.querySelectorAll('.fa-check').length >= 1 ? true : false;
   }
    
// TO CHECK IF THE user HAS CHECKED A PARTICULAR ACTIVITY BEFORE
   var doubleCheckId = function (id) {
        var checked = document.getElementById(id).firstChild.lastChild.firstChild.className.includes('fa-check');
        return checked  === true ? true : false; 
   }
   
// Uncheck the activites
   var uncheckActivity = function (id) {
        document.getElementById(id).firstChild.lastChild.firstChild.classList.remove('fa-check');
   }
    

// WHEN USER SELECTS ONE OF THE ACTIVITIES
    // Note: A fine place to event delegation
   _$('.collection').addEventListener('click', function (event) {
        var id   = event.target.parentNode.id;
        var data = event.target.parentNode.dataset.hollandcode;        
        var text = event.target.firstChild.textContent;

        if(id !== ""){
            // Check if the selected activities has been previously checked
            if(doubleCheckId(id) === true){

               // Uncheck the activites
                  uncheckActivity(id);

               // Delete user selection form the internal data structure
                  dataStructure('delete', id);
            }else{
                
                // Add user selection to the internal data structure id, action, data
                   dataStructure('add', id, data);

                // check the selected activity
                event.target.lastChild.firstChild.classList.add('fa-check');

            } 
        }
   });

      
   




