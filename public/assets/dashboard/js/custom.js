/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

// Get the toggle button and the logos
var collapseBtn = document.querySelector(".collapse-btn");
var largeLogo = document.querySelector(".logo-name");
var smallLogo = document.querySelector(".applogo");

// Hide the small logo initially
smallLogo.style.display = "none";

// Add click event listener to the toggle button
collapseBtn.addEventListener("click", function (event) {
  event.preventDefault(); // Prevent the default behavior of the link

  // Get the computed style of the large logo
  var largeLogoDisplay = window.getComputedStyle(largeLogo).display;

  // Check the visibility of the large logo
  if (largeLogoDisplay === "none") {
    // If large logo is hidden, show it and hide the small logo
    largeLogo.style.display = "block";
    smallLogo.style.display = "none";
  } else {
    // If large logo is visible, hide it and show the small logo
    largeLogo.style.display = "none";
    smallLogo.style.display = "block";
  }
});

// --------------------------------------

// $(document).ready(function () {
//   $(".menu-toggle").click(function (event) {
//     event.preventDefault();
//     // Toggle the 'active' class on the parent <li>
//     $(this).closest("li").toggleClass("active");
//   });

//   // Ensure the dropdown stays open when a link inside it is clicked
//   $(".dropdown-menu .nav-link").click(function (event) {
//     event.preventDefault();
//     console.log("Link clicked:", $(this).attr("href"));
//     // Optionally, perform some action when a link is clicked
//   });
// });

// $(document).ready(function () {
//   $(".menu-toggle").click(function (event) {
//     event.preventDefault();
//     // Toggle the 'active' class on the parent <li> to show or hide the dropdown
//     $(this).closest("li").toggleClass("active");
//   });

//   // Ensure the dropdown remains open when a link is clicked, and allow navigation
//   $(".dropdown-menu .nav-link").click(function (event) {
//     // Stop the dropdown from closing by preventing the event from bubbling
//     event.stopPropagation();
//     // No event.preventDefault(), so the link will navigate normally
//   });
// });

// $(document).ready(function () {
//   $(".menu-toggle").click(function (event) {
//     event.preventDefault();
//     // Toggle the 'active' class on the parent <li>
//     $(this).closest("li").toggleClass("active");
//   });

//   // Allow navigation when clicking on a link in the dropdown
//   $(".dropdown-menu .nav-link").click(function () {
//     console.log("Navigating to:", $(this).attr("href"));
//     // No event.preventDefault(), so the link will navigate normally
//   });
// });

$(document).ready(function () {
  // Check the current URL and set the active class for the correct item
  var currentUrl = window.location.href;

  $(".nav-link").each(function () {
    if (this.href === currentUrl) {
      // Add 'active' class to the parent <li> of the matching link
      $(this).closest("li").addClass("active");

      // If the link is inside a dropdown, ensure it stays open
      var parentDropdown = $(this).closest(".dropdown");
      if (parentDropdown.length) {
        parentDropdown.addClass("active");
        parentDropdown.find(".dropdown-menu").addClass("show"); // Ensure dropdown is visible
      }
    }
  });

  // Handle the click event for menu-toggle (to toggle dropdowns)
  $(".menu-toggle").click(function (event) {
    event.preventDefault();
    var parentLi = $(this).closest("li");

    // Toggle the 'active' class on the parent <li> and dropdown visibility
    parentLi.toggleClass("active");

    // Ensure the dropdown menu is shown or hidden based on the class
    if (parentLi.hasClass("active")) {
      parentLi.find(".dropdown-menu").addClass("show");
    } else {
      parentLi.find(".dropdown-menu").removeClass("show");
    }
  });

  // Ensure the dropdown stays open when a link inside it is clicked
  $(".dropdown-menu .nav-link").click(function () {
    // Optionally, you can perform actions when a dropdown link is clicked
    // For now, we just log the href to the console
    console.log("Link clicked:", $(this).attr("href"));
  });
});
