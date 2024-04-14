<!-- jquery -->
<script src="<?= base_url() ?>assets_landingpage/js/jquery-1.11.3.min.js"></script>
<!-- bootstrap -->
<script src="<?= base_url() ?>assets_landingpage/bootstrap/js/bootstrap.min.js"></script>
<!-- count down -->
<script src="<?= base_url() ?>assets_landingpage/js/jquery.countdown.js"></script>
<!-- isotope -->
<script src="<?= base_url() ?>assets_landingpage/js/jquery.isotope-3.0.6.min.js"></script>
<!-- waypoints -->
<script src="<?= base_url() ?>assets_landingpage/js/waypoints.js"></script>
<!-- owl carousel -->
<script src="<?= base_url() ?>assets_landingpage/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="<?= base_url() ?>assets_landingpage/js/jquery.magnific-popup.min.js"></script>
<!-- mean menu -->
<script src="<?= base_url() ?>assets_landingpage/js/jquery.meanmenu.min.js"></script>
<!-- sticker js -->
<script src="<?= base_url() ?>assets_landingpage/js/sticker.js"></script>
<!-- main js -->
<script src="<?= base_url() ?>assets_landingpage/js/main.js"></script>

<script type="text/javascript">
	(function(w, d, v3) {
		w.chaportConfig = {
			appId: '661be9dc7db7c259746c97d2'
		};

		if (w.chaport) return;
		v3 = w.chaport = {};
		v3._q = [];
		v3._l = {};
		v3.q = function() {
			v3._q.push(arguments)
		};
		v3.on = function(e, fn) {
			if (!v3._l[e]) v3._l[e] = [];
			v3._l[e].push(fn)
		};
		var s = d.createElement('script');
		s.type = 'text/javascript';
		s.async = true;
		s.src = 'https://app.chaport.com/javascripts/insert.js';
		var ss = d.getElementsByTagName('script')[0];
		ss.parentNode.insertBefore(s, ss)
	})(window, document);
</script>