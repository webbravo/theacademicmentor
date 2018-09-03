[].forEach.call(document.querySelectorAll('img[data-src]'),    function(img) {
  img.setAttribute('src', img.getAttribute('data-src'));
  img.onload = function() {
    img.removeAttribute('data-src');
  };
});

$('.dropdown-button').dropdown({
  inDuration: 300,
  outDuration: 225,
  constrainWidth: false, // Does not change width of dropdown to that of the activator
  hover: true, // Activate on hover
  gutter: 0, // Spacing from edge
  belowOrigin: true, // Displays dropdown below the button
  alignment: 'left', // Displays dropdown with edge aligned to the left of button
  stopPropagation: false // Stops event propagation
}
);

$(".button-collapse").sideNav() ; 
$('.modal').modal({
  dismissible: true, // Modal can be dismissed by clicking outside of the modal
  opacity: .8, // Opacity of modal background
  inDuration: 300, // Transition in duration
  outDuration: 200, // Transition out duration
  startingTop: '4%', // Starting top style attribute
  endingTop: '10%', // Ending top style attribute
  // ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
  //     alert("Ready");
  //     console.log(modal, trigger);
  // },
  // complete: function() { alert('Closed'); } // Callback for Modal close
});
  // var node = document.querySelectorAll('iframe');

  // for (let i = 0; i < node.length; i++) {
  //     // Create the Div 
  //     var firstDiv = document.createElement("div").id = "video-"+i;

  //     // Append the videos to the post-wrapper DIV
  //      document.getElementsByClassName("post-wrapper").appendChild("firstDiv") ; 

  //     // Give the just created div a classname   
  //      document.getElementById("video-"+i).className = 'video-container';
      
  //     // Select the Div
  //         let videoDiv = document.getElementById("video-"+i);
          
  //     //SELECT ONE NODE
  //         var videoNode = node[i];
      
  //     // Put the Video inside the of the Div using it's ID
  //         var finalDiv = videoDiv.innerHTML = videoNode
      
  //     // Append the videos to the post-wrapper DIV
  //         document.getElementsByClassName("post-wrapper").appendChild(finalDiv);   
  // }
