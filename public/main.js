// if user is not logged in, redirect him to sign up page
// if (window.location.pathname === '/public/index.html' || window.location.pathname === '/public/About.html' || window.location.pathname === '/public/ContactUs.html' || window.location.pathname === '/public/createPost.html' 
//         || window.location.pathname === '/public/forgotPassword.html' || window.location.pathname === '/public/informationDataPolicy.html' || window.location.pathname === '/public/informationTermsOfUse.html' 
//         || window.location.pathname === '/public/ModPolicy.html' || window.location.pathname === '/public/nonprofit.html' || window.location.pathname === '/public/PrivacyPolicy.html' && !localStorage.getItem('token')) {
//     window.location.href = '/signup';
// }

//Make the header disappear on scroll down and re-appear on scroll up//
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("header").style.top = "0";
  } else {
    document.getElementById("header").style.top = "-100px";
  }
  prevScrollpos = currentScrollPos;
  //make the transition smooth
    document.getElementById("header").style.transition = "top 0.8s";
    
}

//Press button to smoothly go to top of page
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    //smooth transition
    document.documentElement.style.transition = "top 0.8s";
    
    }


// function to change the button between text and image in the createPost page
function changeButton() {
  if (document.getElementById("textArea").classList.contains("hidden")) {
    document.getElementById("imageUpload").classList.add("hidden");
    document.getElementById("textArea").classList.remove("hidden");
    // Change the background color and text color of the textButton to the colors of the imageButton using classList
    document.getElementById("textButton").classList.add("bg-[#ff4057]");
    document.getElementById("textButton").classList.remove("bg-zinc-800");
    document.getElementById("textButton").classList.add("text-white");
    document.getElementById("textButton").classList.remove("text-[#ff4057]");
    document.getElementById("textButton").classList.remove("hover:text-[#ff4957]");
    document.getElementById("imageButton").classList.add("bg-zinc-800");
    document.getElementById("imageButton").classList.remove("bg-[#ff4057]");
    document.getElementById("imageButton").classList.add("text-[#ff4057]");
    document.getElementById("imageButton").classList.remove("text-white");
    document.getElementById("imageButton").classList.add("hover:text-white");
    document.getElementById("imageButton").classList.add("hover:bg-[#ff4957]");
  } else {
    document.getElementById("textArea").classList.add("hidden");
    document.getElementById("imageUpload").classList.remove("hidden");
    // Change the background color and text color of the imageButton to the colors of the TextButton using classList
    document.getElementById("imageButton").classList.add("bg-[#ff4057]"); 
    document.getElementById("imageButton").classList.remove("bg-zinc-800");
    document.getElementById("imageButton").classList.add("text-white");
    document.getElementById("imageButton").classList.remove("text-[#ff4057]");
    document.getElementById("imageButton").classList.remove("hover:text-[#ff4957]");
    document.getElementById("textButton").classList.add("bg-zinc-800");
    document.getElementById("textButton").classList.remove("bg-[#ff4057]");
    document.getElementById("textButton").classList.add("text-[#ff4057]");
    document.getElementById("textButton").classList.remove("text-white");
    document.getElementById("textButton").classList.add("hover:text-white");
  }
}

// Loader function that transitions smoothly from loader to page
document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
      document.querySelector("body").style.visibility = "hidden";
      document.querySelector("#loader").style.visibility = "visible";
    } else {
      // Make the body visible again with a smooth transition
      document.querySelector("#loader").style.display = "none";
      document.querySelector("body").style.visibility = "visible";
    }

// Open pop-up window with id of "survey-popup" when the user stays on the page for 5 minutes
setTimeout(function() {
  document.getElementById("survey-popup").classList.remove("hidden");
  document.getElementById("survey-popup").classList.add("flex");
  document.getElementById("survey-popup").classList.add("justify-center");
// add to body the class of "overflow-hidden" to prevent scrolling when the pop-up window is open
  document.querySelector("body").classList.add("overflow-hidden");
  document.querySelector("header").classList.add("hidden");
  // automatically bring user to top of page when pop-up window opens
  window.scrollTo(0, 0);
}, 3000);
}

// Close pop-up window with id of "survey-popup" when the user clicks on the "X" button, then add to the id of the pop-up window the class of "hidden"
function closeSurvey() {
  document.getElementById("survey-popup").classList.add("hidden");
  document.getElementById("survey-popup").classList.remove("flex");
  document.getElementById("survey-popup").classList.remove("justify-center");
// remove from body the class of "overflow-hidden" to allow scrolling when the pop-up window is closed
  document.querySelector("body").classList.remove("overflow-hidden");
  document.querySelector("header").classList.remove("hidden");
}
