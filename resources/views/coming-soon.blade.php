<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | Lumex</title>
    <meta name="description" content="Lumex - Electrical solutions. We're launching something powerful soon.">
    <link rel="icon" href="{{ get_file('uploads/logo/favicon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#0b1020;--card:#0f1733;--primary:#ffd166;--accent:#00d1ff;--red:#ff3b3b;--text:#e8edf7;--muted:#a8b0c6}
        *{box-sizing:border-box}
        html,body{height:100%}
        body{margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:radial-gradient(1100px 500px at 70% 10%,rgba(0,209,255,.08),transparent),radial-gradient(900px 450px at 10% 10%,rgba(255,59,59,.08),transparent),radial-gradient(800px 400px at 0% 100%,rgba(255,209,102,.08),transparent),var(--bg);color:var(--text);}
        .container{min-height:100%;display:flex;align-items:center;justify-content:center;padding:40px}
        .topbar{position:fixed;top:0;left:0;right:0;display:flex;justify-content:flex-end;align-items:center;padding:14px 24px;background:linear-gradient(180deg,rgba(11,16,32,.75),rgba(11,16,32,0));z-index:10}
        .login-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);text-decoration:none;font-weight:700}
        .login-btn:hover{background:rgba(255,59,59,.12);border-color:rgba(255,59,59,.35)}
        .card{position:relative;width:100%;max-width:980px;background:linear-gradient(180deg,rgba(255,255,255,.04),rgba(255,255,255,.02));border:1px solid rgba(255,255,255,.08);border-radius:20px;backdrop-filter:blur(8px);box-shadow:0 0 0 1px rgba(255,59,59,.06),0 20px 60px rgba(0,0,0,.45);overflow:hidden}
        .grid{display:grid;grid-template-columns:1.1fr .9fr}
        @media (max-width:900px){.grid{grid-template-columns:1fr}.right{display:none}}
        .left{padding:56px 48px}
        .brand{display:flex;align-items:center;gap:14px;margin-bottom:18px}
        .logo{width:44px;height:44px;display:grid;place-items:center;border-radius:12px;background:linear-gradient(135deg,var(--primary),#ff8c00);box-shadow:0 0 0 2px rgba(255,59,59,.25),0 6px 18px rgba(0,0,0,.35)}
        .logo svg,.logo img{filter:drop-shadow(0 2px 8px rgba(0,0,0,.35));width:22px;height:22px}
        .brand h1{margin:0;font-weight:800;letter-spacing:.5px}
        .badge{display:inline-flex;align-items:center;gap:8px;font-size:12px;color:#06121a;background:linear-gradient(135deg,var(--red),var(--accent));padding:6px 10px;border-radius:999px;font-weight:700;margin-top:8px}
        .title{font-size:42px;line-height:1.15;margin:22px 0 14px}
        .subtitle{color:var(--muted);font-size:16px;max-width:56ch}
        .timer{display:flex;gap:14px;margin:28px 0 34px}
        .tbox{flex:1;min-width:70px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:14px 10px;text-align:center}
        .tbox strong{display:block;font-size:26px;color:var(--red)}
        .tbox span{color:var(--muted);font-size:12px}
        .cta{display:flex;flex-wrap:wrap;gap:12px;margin-top:8px}
        .cta a{display:inline-flex;align-items:center;gap:10px;text-decoration:none;padding:12px 16px;border-radius:12px;border:1px solid rgba(255,255,255,.12);color:var(--text);background:rgba(255,255,255,.02)}
        .cta a.primary{background:linear-gradient(135deg,var(--primary),#ffb703);color:#0b0f1a;border:none;font-weight:800}
        .contact{margin-top:28px;padding-top:18px;border-top:1px dashed rgba(255,255,255,.12);display:grid;grid-template-columns:1fr 1fr;gap:14px}
        @media (max-width:520px){.contact{grid-template-columns:1fr}.title{font-size:32px}}
        .contact div{display:flex;gap:10px;align-items:flex-start;color:var(--muted)}
        .right{position:relative;overflow:hidden}
        .hero{position:absolute;inset:0;background:radial-gradient(600px 300px at 30% 40%,rgba(0,209,255,.18),transparent),radial-gradient(600px 300px at 80% 70%,rgba(255,209,102,.18),transparent)}
        .panel{position:absolute;right:-30px;top:50%;transform:translateY(-50%) rotate(-6deg);width:520px;max-width:90%;background:linear-gradient(180deg,rgba(255,255,255,.06),rgba(255,255,255,.02));border:1px solid rgba(255,255,255,.1);border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,.5);padding:18px}
        .panel-inner{border-radius:14px;border:1px dashed rgba(255,255,255,.14);padding:18px}
        .list{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .chip{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);padding:10px 12px;border-radius:10px;font-size:13px;display:flex;gap:8px;align-items:center}
        .chip:hover{border-color:rgba(255,59,59,.5)}
        .footer{display:flex;justify-content:space-between;align-items:center;padding:14px 18px;border-top:1px solid rgba(255,255,255,.08);font-size:12px;color:var(--muted)}
        .footer span:last-child{color:var(--red)}
        .sr{position:absolute;left:-9999px}
    </style>
    <script>
        document.addEventListener('DOMContentLoaded',()=>{
            const target=new Date();
            target.setDate(target.getDate()+30);
            const el=(id)=>document.getElementById(id);
            const tick=()=>{
                const now=new Date();
                const diff=Math.max(0,target-now);
                const d=Math.floor(diff/(1000*60*60*24));
                const h=Math.floor((diff/(1000*60*60))%24);
                const m=Math.floor((diff/(1000*60))%60);
                const s=Math.floor((diff/1000)%60);
                el('d').textContent=String(d).padStart(2,'0');
                el('h').textContent=String(h).padStart(2,'0');
                el('m').textContent=String(m).padStart(2,'0');
                el('s').textContent=String(s).padStart(2,'0');
            };
            tick();
            setInterval(tick,1000);
        });
    </script>
    <!--
        To customize phone and address, update the spans with ids phone-text and address-text below.
    -->
    </head>
<body>
    <div class="topbar">
        <a class="login-btn" href="{{ route('login') }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M10 17l5-5-5-5v3H3v4h7v3zm9-13h-8v2h8v12h-8v2h8a2 2 0 002-2V6a2 2 0 00-2-2z"/></svg>
            <span>Login</span>
        </a>
    </div>
    <div class="container">
        <div class="card grid">
            <div class="left">
                <div class="brand">
                    <div class="logo" aria-hidden="true">
                        <img src="{{ get_file('uploads/logo/favicon.png') }}" alt="Lumex Favicon">
                    </div>
                    <h1>Lumex Lighting</h1>
                </div>
                <span class="badge">Suivi de projet et Coordination</span>
                <h2 class="title">Conception et fourniture d’éclairage sur mesure, alliant performance et design.</h2>
                <p class="subtitle">Depuis 2007, Lumex accompagne architectes, entreprises et particuliers avec des solutions d’éclairage sur mesure adaptées à chaque besoin. Notre nouveau site arrive bientôt.</p>

                <div class="timer" role="timer" aria-live="polite">
                    <div class="tbox"><strong id="d">00</strong><span>Days</span></div>
                    <div class="tbox"><strong id="h">00</strong><span>Hours</span></div>
                    <div class="tbox"><strong id="m">00</strong><span>Minutes</span></div>
                    <div class="tbox"><strong id="s">00</strong><span>Seconds</span></div>
                </div>

                

                <div class="contact">
                    <div>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.6 10.2c1.2 2.4 3.1 4.3 5.5 5.5l2-2c.3-.3.8-.4 1.2-.2 1 .3 2 .5 3 .5.7 0 1.2.5 1.2 1.2V18c0 .7-.5 1.2-1.2 1.2C10.8 19.2 4.8 13.2 4.8 5.4 4.8 4.7 5.3 4.2 6 4.2h2.7c.7 0 1.2.5 1.2 1.2 0 1 .2 2 .5 3 .1.4 0 .9-.3 1.2l-2 2.6z" fill="currentColor"/></svg>
                        <span id="phone-text">Phone: +212661142161</span>
                    </div>
                    <div>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C7.6 2 4 5.6 4 10c0 5.2 6.6 11.5 7.1 11.9.5.4 1.3.4 1.8 0C13.4 21.5 20 15.2 20 10c0-4.4-3.6-8-8-8zm0 11.2c-1.8 0-3.2-1.4-3.2-3.2S10.2 6.8 12 6.8s3.2 1.4 3.2 3.2-1.4 3.2-3.2 3.2z" fill="currentColor"/></svg>
                        <span id="address-text">Address: 132 Rue Brahim Nakhai, Casablanca</span>
                    </div>
                </div>
            </div>
            <div class="right" aria-hidden="true">
                <div class="hero"></div>
                <div class="panel">
                    <div class="panel-inner">
                        <div class="list">
                            <div class="chip">💡 Conception et étude d’éclairage</div>
                            <div class="chip">📦 Fourniture du matériel d’éclairage</div>
                            <div class="chip">🤝 Conseil & Accompagnement</div>
                            <div class="chip">⚙️ Optimisation Énergétique</div>
                            <div class="chip">🏛️ Scénographie de Façades</div>
                        </div>
                    </div>
                    <div class="footer">
                        <span>© <span id="year"></span> Lumex. All rights reserved.</span>
                        <span>Made with ⚡</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>document.getElementById('year').textContent=new Date().getFullYear()</script>
</body>
</html>

