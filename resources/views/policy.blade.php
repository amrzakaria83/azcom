<!DOCTYPE html>
<html @if (App::getLocale() == 'ar') lang="ar" direction="rtl" dir="rtl" style="direction: rtl;" @else lang="en" @endif>
	<!--begin::Head-->
	<head><base href="{{asset('dash/assets/')}}"/>
		<title>{{$settings->append_name}}</title>
		<meta charset="utf-8" />
		<meta name="description" content="{{$settings->append_description}}" />
		<meta name="keywords" content="{{$settings->append_keywords}}" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="shortcut icon" href="{{$settings->getFirstMediaUrl('fav')}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

		@if (App::getLocale() == 'ar')
			<link href="{{asset('dash/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('dash/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		@else
			<link href="{{asset('dash/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('dash/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		@endif
		
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center">

		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url("{{asset('dash/assets/media/auth/14-2.jpg')}}"); } [data-bs-theme="dark"] body { background-image: url("{{asset('dash/assets/media/auth/bg6-dark.jpg')}}"); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
						<!--begin::Image-->
						<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{$settings->getFirstMediaUrl('logo')}}" alt="" />
						<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{$settings->getFirstMediaUrl('logoDark')}}" alt="" />
						<!--end::Image-->
					</div>
					<!--end::Content-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<!--begin::Wrapper-->
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
						<!--begin::Content-->
						<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
							<!--begin::Wrapper-->
							<div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
								<!--begin::Form-->
								<div class="row justify-content-center">
							<div class="col-12 col-md-12">
								<!-- Single Card -->
								<div class="card bg-inherit border-0">
									<!-- Card Body -->
									<h2 class="text-capitalize" style="text-align:left;">Privacy Policy</h2>
									<div class="card-body px-0 py-3" style="text-align: left;">
									    
										<p>Privacy Policy and Terms and Conditions for Mobile Applications Collection and Use of Information<br>For a better experience while using our Service, we may ask you to provide us with certain personally identifiable information. Information requested by us will be retained and used as described in this Privacy Policy. The App uses third party services that may collect information used to identify you.</p>
<p>Cookies Cookies<br>Cookies are files with small amount of data that are commonly used as anonymous unique identifiers. They are sent to your browser on websites you visit and are stored on your device's internal memory.</p>
<p>This service does not explicitly use these "cookies". However, the Application may employ third parties who use “cookies” to collect information and improve their services. You have the option to accept or reject these cookies and know when a cookie is being sent to your device. If you choose to decline our cookies, you may not be able to use some parts of the Service.</p>
<p>We would like to inform users of this service that third parties have access to your personal information and the reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>
<p>Safety<br>We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the Internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>
<p>External links on our website<br>Some pages of our site contain external links. You are advised to check the privacy practices of these other sites. We are not responsible for the use or misuse of information on these other sites. We encourage you not to provide personal information without reviewing the privacy policy statements of other sites.</p>
<p>&nbsp;</p>
<p>Changes to This Privacy Policy<br>We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately after they are posted on this page.</p>
<p>Connect with us<br>If you have any questions or concerns regarding this Privacy Policy Statement, please contact us at info@nutrimedme.com We will respond to all inquiries within 30 days of receipt upon confirmation of your identity.</p>
									
									<p>contact us :</p>
									<p>+201006287379</p>
									<p>info@nutrimedme.com</p>
									</div>
								</div>
							</div>
						</div>
								<!--end::Form-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "{{asset('dash/assets/')}}";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{asset('dash/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('dash/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{asset('dash/assets/js/custom/authentication/sign-in/general.js')}}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->

		<script>
			var defaultThemeMode = "light"; 
			var themeMode; 
			if ( document.documentElement ) { 
				if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { 
					themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); 
				} else { 
					if ( localStorage.getItem("data-bs-theme") !== null ) { 
						themeMode = localStorage.getItem("data-bs-theme"); 
					} else { 
						themeMode = defaultThemeMode; 
					} 
				} 
				if (themeMode === "system") { 
					if ( window.matchMedia("(prefers-color-scheme: dark)").matches == "dark") {
						themeMode = "dark";
					} else {
						themeMode = "light";
					}
				} 
				document.documentElement.setAttribute("data-bs-theme", themeMode); 
			}
		</script>
	</body>
	<!--end::Body-->
</html>