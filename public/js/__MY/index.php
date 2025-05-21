<!DOCTYPE html>
<html lang="en">
	<head><?php
		$NS=(!empty($_GET['NS']))?$_GET['NS']:'__MY';
		$PATH=dirname($_SERVER['SCRIPT_NAME']);
		$BASE='//'.$_SERVER['HTTP_HOST'].$PATH;
	?>
		<!-- 
		** NS.........: "<?=$NS?>"
		** SCRIPT_NAME: "<?=$_SERVER['SCRIPT_NAME']?>"
		** REQUEST_URI: "<?=$_SERVER['REQUEST_URI']?>" 
		** PHP_SELF...: "<?=$_SERVER['PHP_SELF']?>"
		** BASE.......: "<?=$BASE?>"
		-->
		<title>hello <?=$NS?></title>
<?php if(!empty($_GET['jquery'])): ?>
		<script src="https://bloximages.newyork1.vip.townnews.com/stltoday.com/shared-content/art/tncms/templates/libraries/flex/components/jquery/resources/scripts/jquery.min.6edb5af3e93b0a377ec925c5f1c6ddde.js"></script>
		<script>console.log('loading jQuery from BLOX')</script>
<?php else: ?>
		<script>console.log('pass jquery=true to load jQuery from BLOX')</script>
<?php endif; ?>
	</head>
	<body>
	<script id="my_loader">
	(function(g,i,z,m,o,e,s){if(z[g])return;
	s=function(){e=m.createElement(o);r=i+'#'+g;z[g][o]=e;e.src=r;m.head.appendChild(e)}
	z[g]=function(c){z[g].cmds=z[g].cmds||[];z[g].cmds.push(c);if(!z[g][o])s()}
	})("<?=$NS?>","<?=$BASE?>/js/main.js",window,document,'script');
	</script>
	<script>
	(function(g,i,z,m,o,e,s) {var me=z=g.<?=$NS?>;s=z.user=z.user||{};s.is_logged_in=!!0;
	z.sid=function(){var sid=g.sessionStorage.getItem('<?=$NS?>_SID');if(sid)return sid;sid=''+((new Date()).getTime())+'.'+(Math.floor(Math.random() * 2147483647));g.sessionStorage.setItem('<?=$NS?>_SID',sid);return sid};
	z.eid=function(){var eic=(1*sessionStorage.getItem('<?=$NS?>_EIC')); eid=<?=$NS?>.sid()+'.'+(++eic);sessionStorage.setItem('<?=$NS?>_EIC',eic);return eid}
	z.getURLParameter=function(n){return decodeURIComponent((new RegExp('[?|&]'+n+'='+'([^&;]+?)(&|#|;|$)').exec(window.location.search)||[null,''])[1].replace(/\+/g,'%20'))||null};
	z.getCookie=function(n){var v=i.cookie.match('(^|;) ?'+n+'=([^;]*)(;|$)');return v?v[2]:null};
	z.decodeJWT=function(t){var b=t.split('.')[1],c=b.replace(/-/g, '+').replace(/_/g, '/'),d=decodeURIComponent(atob(c).split('').map(function(c){return '%'+('00'+c.charCodeAt(0).toString(16)).slice(-2)}).join(''));return JSON.parse(d)};
	z.sgi=g.sessionStorage.getItem.bind(g.sessionStorage);z.ssi=g.sessionStorage.setItem.bind(g.sessionStorage);
	z.sha256=(function(){return function r(t){function n(r,t){return r>>>t|r<<32-t}for(var o,e,f=Math.pow,h=f(2,32),a="",l=[],g=8*t.length,c=r.h=r.h||[],i=r.k=r.k||[],u=i.length,v={},s=2;u<64;s++)if(!v[s]){for(o=0;o<313;o+=s)v[o]=s;c[u]=f(s,.5)*h|0,i[u++]=f(s,1/3)*h|0}for(t+="\x80";t.length%64-56;)t+="\0";for(o=0;o<t.length;o++){if((e = t.charCodeAt(o))>>8)return;l[o>>2]|=e<<(3-o)%4*8}for(l[l.length]=g/h|0,l[l.length]=g,e=0;e<l.length;){var k=l.slice(e,e+=16),d=c;for(c=c.slice(0, 8),o=0;o<64;o++){var p=k[o-15],w=k[o-2],A=c[0],C=c[4],M=c[7]+(n(C,6)^n(C,11)^n(C,25))+(C&c[5]^~C&c[6])+i[o]+(k[o]=o<16?k[o]:k[o-16]+(n(p,7)^n(p,18)^p>>>3)+k[o-7]+(n(w,17)^n(w,19)^w>>>10)|0);(c=[M+((n(A,2)^n(A,13)^n(A,22))+(A&c[1]^A&c[2]^c[1]&c[2]))|0].concat(c))[4]=c[4]+M|0}for(o=0;o<8;o++)c[o]=c[o]+d[o]|0}for(o=0;o< 8;o++)for(e=3;e+1;e--){var S=c[o]>>8*e&255;a+=(S<16?0:"")+S.toString(16)}return a}})();
	if(m=z.getCookie('tncms-user')){s.is_logged_in=!0;m=z.decodeJWT(m);s.uuid=m.sub;s.sha256=m.app.user.eml.sha256;s.sha1=m.app.user.eml.sha1;s.username=m.app.user.scr}else{s.is_logged_in=!!0;s.uuid="";s.sha256="";s.sha1="";s.username="anonymous"}
	})(window,document)
	</script>
	<script>
            <?=$NS?>(function(me){
				me.require(['domReady','demo'],function(domReady,demo) {
					domReady(demo);
				})
			})
			<?=$NS?>(function(me) {
				me.require(['jquery'],function($) {
					me.say('jquery is ',$);
				});
			});
        </script>
		<div id="stage-01"></div>
		<script>
			(function() {
				var container=document.getElementById('stage-01');
				var stage=document.createElement('form');
				container.appendChild(stage);
				<?=$NS?>(function(me) {
					var e=document.createElement('h2');
					e.innerText="Widget Tag:";
					stage.appendChild(e);
					e=document.createElement('textarea');
					e.setAttribute('style','width:100%;height:8em;font-family: Courier New,courier;');
					e.appendChild(document.createTextNode('\x3cscript\x3e\x0d\x0a    '));
					e.appendChild(document.createTextNode(document.getElementById('lee_loader').innerHTML.trim()));
					e.appendChild(document.createTextNode('\x0d\x0a\x3c/script\x3e'));
					stage.appendChild(e);
					console.log(stage);
				});
			})()
		</script>
    </body>
</html>
