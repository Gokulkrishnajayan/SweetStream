"use strict";

// Mode switch functionality
$("#modeSwitcher").on("click", function(e) {
  e.preventDefault();
  modeSwitch();
  location.reload();
});

// Sidebar toggle
$(".collapseSidebar").on("click", function(e) {
  $(".vertical").hasClass("narrow") ? $(".vertical").toggleClass("open") : ($(".vertical").toggleClass("collapsed"), $(".vertical").hasClass("hover") && $(".vertical").removeClass("hover"));
  e.preventDefault();
});

// Sidebar hover effect
$(".sidebar-left").hover(function() {
  $(".vertical").hasClass("collapsed") && $(".vertical").addClass("hover");
  $(".narrow").hasClass("open") || $(".vertical").addClass("hover");
}, function() {
  $(".vertical").hasClass("collapsed") && $(".vertical").removeClass("hover");
  $(".narrow").hasClass("open") || $(".vertical").removeClass("hover");
});

// Navbar toggle
$(".toggle-sidebar").on("click", function() {
  $(".navbar-slide").toggleClass("show");
});

// Dropdown toggle
(function(a) {
  a(".dropdown-menu a.dropdown-toggle").on("click", function(e) {
    return a(this).next().hasClass("show") || a(this).parents(".dropdown-menu").first().find(".show").removeClass("show"),
    a(this).next(".dropdown-menu").toggleClass("show"),
    a(this).parents("li.nav-item.dropdown.show").on("hidden.bs.dropdown", function(e) {
      a(".dropdown-submenu .show").removeClass("show");
    }), !1;
  });
})(jQuery);

// Dropdown behavior
$(".navbar .dropdown").on("hidden.bs.dropdown", function() {
  $(this).find("li.dropdown").removeClass("show open");
  $(this).find("ul.dropdown-menu").removeClass("show open");
});

// File panel click - COMMENTED OUT
// $(".file-panel .card").on("click", function() {
//   $(this).hasClass("selected") ? ($(this).removeClass("selected"), $(this).find("bg-light").removeClass("shadow-lg"), $(".file-container").removeClass("collapsed")) : ($(this).addClass("selected"), $(this).addClass("shadow-lg"), $(".file-panel .card").not(this).removeClass("selected"), $(".file-container").addClass("collapsed"));
// });

// Close info panel - COMMENTED OUT
// $(".close-info").on("click", function() {
//   $(".file-container").hasClass("collapsed") && ($(".file-container").removeClass("collapsed"), $(".file-panel").find(".selected").removeClass("selected"));
// });

// Stick on scroll (for sticky elements)
$(function() {
  $(".info-content").stickOnScroll({ topOffset: 0, setWidthOnStick: true });
});

// Wizard functionality (Basic)
var basic_wizard = $("#example-basic");
basic_wizard.length && basic_wizard.steps({
  headerTag: "h3",
  bodyTag: "section",
  transitionEffect: "slideLeft",
  autoFocus: true
});

// Vertical wizard
var vertical_wizard = $("#example-vertical");
vertical_wizard.length && vertical_wizard.steps({
  headerTag: "h3",
  bodyTag: "section",
  transitionEffect: "slideLeft",
  stepsOrientation: "vertical"
});

// Form validation and steps
var form = $("#example-form");
form.length && (form.validate({
  errorPlacement: function(e, a) {
    a.before(e);
  },
  rules: {
    confirm: { equalTo: "#password" }
  }
}), form.children("div").steps({
  headerTag: "h3",
  bodyTag: "section",
  transitionEffect: "slideLeft",
  onStepChanging: function(e, a, o) {
    return form.validate().settings.ignore = ":disabled,:hidden", form.valid();
  },
  onFinishing: function(e, a) {
    return form.validate().settings.ignore = ":disabled", form.valid();
  },
  onFinished: function(e, a) {
    alert("Submitted!");
  }
}));

// Chart options and data
var ChartOptions = {
  maintainAspectRatio: false,
  responsive: true,
  legend: { display: false },
  scales: {
    xAxes: [{ gridLines: { display: false } }],
    yAxes: [{ gridLines: { display: false, color: colors.borderColor, zeroLineColor: colors.borderColor } }]
  }
};

// Sample chart data (for various charts)
var ChartData = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
  datasets: [
    {
      label: "Visitors",
      barThickness: 10,
      backgroundColor: base.primaryColor,
      borderColor: base.primaryColor,
      pointRadius: false,
      pointColor: "#3b8bba",
      pointStrokeColor: "rgba(60,141,188,1)",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(60,141,188,1)",
      data: [28, 48, 40, 19, 64, 27, 90, 85, 92],
      fill: "",
      lineTension: 0.1
    },
    {
      label: "Orders",
      barThickness: 10,
      backgroundColor: "rgba(210, 214, 222, 1)",
      borderColor: "rgba(210, 214, 222, 1)",
      pointRadius: false,
      pointColor: "rgba(210, 214, 222, 1)",
      pointStrokeColor: "#c1c7d1",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(220,220,220,1)",
      data: [65, 59, 80, 42, 43, 55, 40, 36, 68],
      fill: "",
      borderWidth: 2,
      lineTension: 0.1
    }
  ]
};

// Create chart (example)
var barChartjs = document.getElementById("barChartjs");
barChartjs && new Chart(barChartjs, { type: "bar", data: ChartData, options: ChartOptions });
