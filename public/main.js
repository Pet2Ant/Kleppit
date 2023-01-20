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

//changeToImageUpload function that changes from textArea to Image upload using classList
function changeToImageUpload() {
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

//changeToTextArea function that changes from Image upload to textArea using classList
function changeToTextArea() {
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
}