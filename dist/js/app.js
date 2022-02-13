(function ($) {
	"use strict";
	var primarycolor = getComputedStyle(document.body).getPropertyValue(
		"--primarycolor"
	);

	//////////////////////// Window On Load //////////////////
	$(window).on("load", function () {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
	});
	$(".sidebar ul")
		.find("a")
		.each(function () {
			if (
				document.location.href.replace(/\/$/, "").replace(/\#$/, "") ==
				$(this).attr("href").replace(/\/$/, "").replace(/\#$/, "")
			) {
				$(this).parents().addClass("active");
				$(this).addClass("active");
				// add class as you need ul or li or a
			}
		});
	///////////////// Flip Menu ///////////

	$(".flip-menu-toggle").on("click", function () {
		$(".flip-menu").toggleClass("active");
	});
	$(".flip-menu-close").on("click", function () {
		$(".flip-menu").toggleClass("active");
	});
	//////////////////////// Chat ////////////////////
	$(".chat-contact").on("click", function () {
		$(".chat-contact-list").toggleClass("active");
	});
	$(".chat-profile").on("click", function () {
		$(".chat-user-profile").toggleClass("active");
	});
	$(".scrollerchat").slimScroll({
		height: "460px",
		color: "#fff",
	});
	/////////////////////// Loader /////////////////////
	var angle = 0;
	setInterval(function () {
		$(".se-pre-con img")
			.css("-webkit-transform", "rotate(" + angle + "deg)")
			.css("-moz-transform", "rotate(" + angle + "deg)")
			.css("-ms-transform", "rotate(" + angle + "deg)");
		angle++;
		angle++;
		angle++;
	}, 10);

	$(".popupchat").slimScroll({
		height: "220px",
		color: "#fff",
	});

	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

	$(".checkall").on("click", function () {
		$(".mail-app input:checkbox").not(this).prop("checked", this.checked);
	});
	/**************** Menu **********************/
	$(".sidebar-menu .dropdown>a").on("click", function () {
		if ($(this).parent().hasClass("active")) {
			$(this).parent().find(">.sub-menu").slideUp("slow");
			$(this).parent().removeClass("active");
		} else {
			$(this).parent().find(">.sub-menu").slideDown("slow");
			$(this).parent().addClass("active");
		}
		return false;
	});

	/**************** Chat Pop Up **********************/
	$(".chatbutton").on("click", function () {
		$(".chatwindow").toggle();
		return false;
	});
	/*==============================================================
     Sidebar 
     ============================================================= */

	$(".sidebarCollapse").on("click", function () {
		$("body").toggleClass("compact-menu");
		$(".sidebar").toggleClass("active");
	});

	$(".mobilesearch").on("click", function () {
		$(".search-form").toggleClass("d-none");
	});

	/////////////////////////// Datepicker ////////////////////////
	if (typeof $.fn.datepicker !== "undefined") {
		$(".datepicker").datepicker();
	}

	/////////////////////////// Wizard Form ////////////////////////

	$(".nexttab").click(function () {
		var nextId = $(this).parents(".tab-pane").next().attr("id");
		$('[href="#' + nextId + '"]').tab("show");
	});

	$(".prevtab").click(function () {
		var nextId = $(this).parents(".tab-pane").prev().attr("id");
		$('[href="#' + nextId + '"]').tab("show");
	});
	/********************************** Image Background *************************/
	$(".background-image-maker").each(function () {
		var imgURL = $(this).next(".holder-image").find("img").attr("src");
		$(this).css("background-image", "url(" + imgURL + ")");
	});

	/********************************** Top Scroll *************************/
	$(".scrollup").on("click", function () {
		$("html, body").animate(
			{
				scrollTop: 0,
			},
			600
		);
		return false;
	});

	/****************************** Window Scroll ****************************/
	$(window).on("scroll", function () {
		/*==============================================================
         Back To Top
         =============================================================*/
		if ($(this).scrollTop() > 100) {
			$(".scrollup").fadeIn();
		} else {
			$(".scrollup").fadeOut();
		}
	});

	/*==============================================================
     Form Validation 
     ============================================================= */
	var forms = document.getElementsByClassName("needs-validation");
	// Loop over them and prevent submission
	var validation = Array.prototype.filter.call(forms, function (form) {
		form.addEventListener(
			"submit",
			function (event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add("was-validated");
			},
			false
		);
	});

	/*==============================================================
     Sidebar Settings 
     ============================================================= */

	var settinghtml = `<div id="settings" class="">
            <a href="#" id="settingbutton" class="setting"> 
                <h5 class="mb-0"><i class="icon-settings"></i></h5>
            </a>
            <div class="sidbarchat p-3">
                <h5 class="mb-0">CHB ADMIN</h5>
                <p>Customize your template</p>
                <hr/>
                <h6>TEMPLATE COLOR</h6>
                <ul class="list-inline float-left claerfix">
                    <li class="color-box m-2 list-inline-item float-left color1" data-color="#1e3d73"></li>
                    <li class="color-box m-2 list-inline-item float-left color2" data-color="#0bb2d4"></li> 
                    <li class="color-box m-2 list-inline-item float-left color3" data-color="#17b3a3"></li>
                    <li class="color-box m-2 list-inline-item float-left color4" data-color="#eb6709"></li>
                    <li class="color-box m-2 list-inline-item float-left color5" data-color="#76c335"></li>
                    <li class="color-box m-2 list-inline-item float-left color6" data-color="#3e8ef7"></li>
					<li class="color-box m-2 list-inline-item float-left color7" data-color="#d7117e"></li>  
                    <li class="float-left list-inline-item"><input type="color" class="cursor-pointer color m-2"  value="#1e3d73"></li>
                </ul>
                <hr class="float-left w-100"/>
               
                <h6>TEMPLATE STYLE</h6>                              
                <label class="chkbox">Light 
                    <input name="style" value="light" class="style" type="radio" >
                    <span class="checkmark"></span>
                </label> <br/>
                <label class="chkbox mt-2">Dark 
                    <input name="style" value="dark" class="style" type="radio" >
                    <span class="checkmark"></span>
                </label> <br/>
                <label class="chkbox mt-2">Semi Dark 
                    <input name="style" value="semi-dark" class="style" type="radio" >
                    <span class="checkmark"></span>
                </label> <br/>
                <label class="chkbox mt-2">Gradient
                    <input name="style" value="gradient" class="style" type="radio" >
                    <span class="checkmark"></span>
                </label> 
                <br/><br/>
                <div class="gradient-img float-left">
                <h6>Gradient Image</h6>
                <ul class="list-inline float-left claerfix p-0">                    
                <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#396e94"  data-img="gradient-bg.jpg">
                <img src="${base_url}dist/images/g.jpg" alt="gradient" width="100"/>
                </li> 
      <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#49424a"  data-img="gradient-bg4.jpg">
                <img src="${base_url}dist/images/g4.jpg" alt="gradient" width="100"/>
                </li>
    <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#eb6709"  data-img="gradient-bg7.jpg">
                <img src="${base_url}dist/images/g7.jpg" alt="gradient" width="100"/>
                </li>
                <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#bb416b"  data-img="gradient-bg1.jpg">
                <img src="${base_url}dist/images/g1.jpg" alt="gradient" width="100"/>
                </li>
                <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#17b3a3"  data-img="gradient-bg2.jpg">
                <img src="${base_url}dist/images/g2.jpg" alt="gradient" width="100"/>
                </li>
                <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#4e7184"  data-img="gradient-bg3.jpg">
                <img src="${base_url}dist/images/g3.jpg" alt="gradient" width="100"/>
                </li>
              
                <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#11d2d7"  data-img="gradient-bg5.jpg">
                <img src="${base_url}dist/images/g5.jpg" alt="gradient" width="100"/>
                </li>
                <li class="gradient-img-block m-2 list-inline-item float-left color2" data-primary="#da88d1"  data-img="gradient-bg6.jpg">
                <img src="${base_url}dist/images/g6.jpg" alt="gradient" width="100"/>
                </li>
                
                </ul>
                </div>
                <br/><br/>
                <hr class="float-left w-100"/>
                <label class="chkbox horizontal mb-2">Horizontal Menu 
                    <input name="horizontal" value="horizontal-menu" class="horizontallayout" type="checkbox" >
                    <span class="checkmark"></span>
                </label><br/>
                <label class="chkbox compact">Compact Sidebar 
                    <input name="compact" value="compact" class="sidebar" type="checkbox" >
                    <span class="checkmark"></span>
                </label>
               

            </div>
        </div>`;

	$("body").append(settinghtml);

	$(".setting").on("click", function () {
		$("#settings").toggleClass("active");
		return false;
	});

	var uri = window.location.href.toString();
	if (uri.indexOf("?") > 0) {
		delete_cookie("menulayout");
		delete_cookie("themecolor");
		delete_cookie("sidebarstyle");
		delete_cookie("horizontal");
		delete_cookie("menuicon");
		delete_cookie2("menulayout");
		delete_cookie2("themecolor");
		delete_cookie2("sidebarstyle");
		delete_cookie2("horizontal");
		delete_cookie2("menuicon");
	}

	////////////////////////////// TEMPLATE Color /////////////////////////
	$(".gradient-img-block").on("click", function () {
		$(".gradient-img-block").removeClass("active");
		$(this).addClass("active");
		var imageUrl = base_url + "dist/images/" + $(this).data("img");
		$(
			".gbackground, .gradient, .gradient #header-fix, .gradient #header-fix .logo-bar,.gradient .sidebar, .gradient .sidebar .dropdown-menu, .gradient #settings .sidbarchat, .gradient.horizontal-menu #header-fix, .gradient.horizontal-menu .sidebar .sidebar-menu > li.active, .gradient.horizontal-menu .sidebar .sidebar-menu > li:hover, .gradient.horizontal-menu .sidebar .sidebar-menu > li ul, .gradient.compact-menu .sidebar, .gradient .dropdown-menu"
		).css("background", "url(" + imageUrl + ")");
		$("body").css("--primarycolor", $(this).data("primary"));
		setCookie("cookiesprimarycolor", $(this).data("primary"), 365);
		setCookie("gradientimg", imageUrl, 365);
		location.reload();
	});
	$(".color-box").on("click", function () {
		$("input.color").val($(this).data("color"));
		$("body").css("--primarycolor", $("input.color").val());
		$(".dark").css("--primarycolor", $("input.color").val());
		$(".semi-dark").css("--primarycolor", $("input.color").val());
		$(".semi-dark-alt").css("--primarycolor", $("input.color").val());
		setCookie("cookiesprimarycolor", $("input.color").val(), 365);
	});
	$("input.color").on("change", function () {
		$("body").css("--primarycolor", $("input.color").val());
		$(".dark").css("--primarycolor", $("input.color").val());
		$(".semi-dark").css("--primarycolor", $("input.color").val());
		$(".semi-dark-alt").css("--primarycolor", $("input.color").val());
		setCookie("cookiesprimarycolor", $(this).val(), 365);
	});

	var cookiesprimarycolor = getCookie("cookiesprimarycolor");
	if (cookiesprimarycolor != null && cookiesprimarycolor != "") {
		$("input.color").val(cookiesprimarycolor);
		$("body").css("--primarycolor", cookiesprimarycolor);
		$(".dark").css("--primarycolor", cookiesprimarycolor);
		$(".semi-dark").css("--primarycolor", cookiesprimarycolor);
		$(".semi-dark-alt").css("--primarycolor", cookiesprimarycolor);
	}

	///////////////////////////////// Sidebar Color //////////////////////////////
	$("input.sidebarcolor").on("change", function () {
		$(".sidebar").css("background", $("input.sidebarcolor").val());
		setCookie("cookiessidebarcolor", $("input.sidebarcolor").val(), 365);
	});
	var cookiessidebarcolor = getUrlParameter("cookiessidebarcolor");
	if (cookiessidebarcolor != null && cookiessidebarcolor != "") {
		setCookie("cookiessidebarcolor", cookiessidebarcolor, 365);
	}
	var themecolor = getCookie("themecolor");
	if (themecolor == "semi-dark") {
		var cookiessidebarcolor = getCookie("cookiessidebarcolor");
		if (cookiessidebarcolor != null && cookiessidebarcolor != "") {
			$("input.sidebarcolor").val(cookiessidebarcolor);
			$(".sidebar").css("background", cookiessidebarcolor);
			$("#header-fix .logo-bar").css("background", cookiessidebarcolor);
		}
	}

	//////////////////////////// TEMPLATE Style //////////////////////////////////

	$(".style").on("click", function () {
		$("body").removeClass(
			"light dark semi-dark dark-alt semi-dark-alt gradient"
		);
		$(
			"body, #header-fix, #header-fix .logo-bar, .sidebar .dropdown-menu, #settings .sidbarchat,.gradient .sidebar, .horizontal-menu #header-fix, .horizontal-menu .sidebar .sidebar-menu > li.active, .horizontal-menu .sidebar .sidebar-menu > li:hover, .horizontal-menu .sidebar .sidebar-menu > li ul, .compact-menu .sidebar, .gradient .dropdown-menu"
		).removeAttr("style");
		$("body").addClass($(this).val());
		$("html").css("--primarycolor", $("input.color").val());
		$(".dark").css("--primarycolor", $("input.color").val());
		$(".semi-dark").css("--primarycolor", $("input.color").val());
		if ($(this).val() == "semi-dark") {
			$(".sidebar").css("background", $("input.sidebarcolor").val());
			$("#header-fix .logo-bar").css(
				"background",
				$("input.sidebarcolor").val()
			);
			$(".sidecolor").show();
		} else {
			$(".sidebar").css("background", "");
			$("#header-fix .logo-bar").css("background", "");
			$(".sidecolor").hide();
		}
		if ($(this).val() == "gradient") {
			$(".gradient-img").show();
		} else {
			delete_cookie("cookiesprimarycolor");
			delete_cookie2("cookiesprimarycolor");
			setCookie("cookiesprimarycolor", "#1e3d73", 365);
			$("html").css("--primarycolor", "#1e3d73");
			$(".gradient-img").hide();
		}
		if ($(this).val() == "dark") {
			delete_cookie("cookiesprimarycolor");
			delete_cookie2("cookiesprimarycolor");
			setCookie("cookiesprimarycolor", "#0bb2d4", 365);
			$(".dark").css("--primarycolor", "#0bb2d4");
			$(".gradient-img").show();
		}
		setCookie("themecolor", $(this).val(), 365);
	});

	var themecolor = getUrlParameter("themecolor");
	if (themecolor != null && themecolor != "") {
		setCookie("themecolor", themecolor, 365);
	}

	var themecolor = getCookie("themecolor");
	if (themecolor != null && themecolor != "") {
		$("body").addClass(themecolor);
		$(".style[value='" + themecolor + "']").prop("checked", true);
		if (themecolor == "semi-dark") {
			$(".sidecolor").show();
		} else {
			$(".sidecolor").hide();
		}
		if (themecolor == "gradient") {
			$(".gradient-img").show();
			var gradientimg = getCookie("gradientimg");
			if (gradientimg != null && gradientimg != "") {
				$(
					".gbackground, .gradient, .gradient #header-fix, .gradient #header-fix .logo-bar,.gradient .sidebar, .gradient .sidebar .dropdown-menu, .gradient #settings .sidbarchat, .gradient.horizontal-menu #header-fix, .gradient.horizontal-menu .sidebar .sidebar-menu > li.active, .gradient.horizontal-menu .sidebar .sidebar-menu > li:hover, .gradient.horizontal-menu .sidebar .sidebar-menu > li ul, .gradient.compact-menu .sidebar, .gradient .dropdown-menu"
				).css("background", "url(" + gradientimg + ")");
			}
		}
	}

	///////////////////////////// Compact Menu /////////////////////////////

	$("input.sidebar").on("click", function () {
		if ($(this).is(":checked")) {
			$("body").addClass("compact-menu");
			$(".smail-icon").hide();

			setCookie("sidebarstyle", "compact-menu", 365);
		} else {
			$("body").removeClass("compact-menu");
			delete_cookie("sidebarstyle");
			delete_cookie2("sidebarstyle");
		}
	});

	var sidebarstyle = getUrlParameter("sidebarstyle");
	if (sidebarstyle != null && sidebarstyle != "") {
		setCookie("sidebarstyle", sidebarstyle, 365);
	}

	var sidebarstyle = getCookie("sidebarstyle");
	if (sidebarstyle != null && sidebarstyle != "") {
		$("body").addClass(sidebarstyle);
		$(".smail-icon").hide();
		$(".sidebar").prop("checked", true);
	}

	///////////////////////////// horizontal Layout /////////////////////////////

	$(".horizontallayout").on("click", function () {
		if ($(this).is(":checked")) {
			$("body").addClass("horizontal-menu");
			setCookie("horizontal", "horizontal-menu", 365);
			$(".compact").hide();
		} else {
			$("body").removeClass("horizontal-menu");
			delete_cookie("horizontal");
			delete_cookie2("horizontal");
			$(".compact").show();
		}
	});
	var horizontalstyle = getUrlParameter("horizontal");
	if (horizontalstyle != null && horizontalstyle != "") {
		setCookie("horizontal", horizontalstyle, 365);
	}

	var horizontalstyle = getCookie("horizontal");
	if (horizontalstyle != null && horizontalstyle != "") {
		$("body").addClass(horizontalstyle);
		$(".horizontallayout").prop("checked", true);
		$(".compact").hide();
	}
})(jQuery);

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(";");
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == " ") {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
function delete_cookie(name) {
	document.cookie =
		name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/chbadmin;";
}
function delete_cookie2(name) {
	document.cookie =
		name +
		"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/chbadmin/" +
		CurrentWebPage +
		";";
}
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split("&"),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split("=");

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined
				? true
				: decodeURIComponent(sParameterName[1]);
		}
	}
}

$(".colorPicker").minicolors({
	animationSpeed: 50,
	animationEasing: "swing",
	changeDelay: 0,
	control: "hue",
	defaultValue: "",
	format: "hex",
	showSpeed: 100,
	hideSpeed: 100,
	inline: false,
	keywords: "",
	letterCase: "lowercase",
	opacity: false,
	position: "bottom left",
	theme: "default",
	swatches: [],
});

$(".toggle_ecommerce_tab").on("click", function () {
	var obj = $(this).data("obj");
	$("." + obj).toggle();
});

var color;
$(".applyColor").on("click", function () {
	if (confirm("Apply This Color")) {
		if ($('[name="color"]').val() == "") {
			$('[name="color"]').val($(".colorPicker").val());
			$(".displayColor").html(
				'<div class="colorCircle" style="background-color:' +
					$(".colorPicker").val() +
					'"></div>'
			);
		} else {
			$('[name="color"]').val(
				$('[name="color"]').val() + ", " + $(".colorPicker").val()
			);
			$(".displayColor").append(
				'<div class="colorCircle"  style="background-color:' +
					$(".colorPicker").val() +
					'"></div>'
			);
		}
	}
});

var alertCount = 0;
function alertMe(msg, timeout) {
	alertCount++;
	var html =
		'<div class="messenger" id="clearMessage' +
		alertCount +
		'">' +
		msg +
		'<a class="clearMessenger close" href="javascript:void(0);" name="clearMessage' +
		alertCount +
		'"><i class="fa fa-times"></i></a> </div>';
	$(".messengerWrapper").append(html);
	$(".messengerWrapper").fadeIn("fast");
	setTimeout(function () {
		_clear("clearMessage" + alertCount);
	}, timeout);
}

function _clear(id) {
	$(".messengerWrapper").find($("#" + id).fadeOut("fast"));
}

$("body").on("click", ".clearMessenger", function () {
	var obj = $(this).attr("name");
	$(".messengerWrapper").find($("#" + obj).fadeOut("fast"));
});

function thereIsAnActivity(activity, option) {
	$.ajax({
		url: base_url + "app/thereIsAnActivity",
		type: "post",
		dataType: "json",
		data: {
			activity: activity,
		},
		success: function (data) {
			alertMe("Created Activity", 4000);
			if (option == "yes") {
				window.location.reload();
			}
		},
		error: function (data) {
			alertMe("Could not Create Activity", 8000);
		},
	});
}
