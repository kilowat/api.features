document.addEventListener("DOMContentLoaded", () => {
    const body = document.querySelector('body');
    const captcha = `
        <div style="position: fixed;
                    right: 0;
                    bottom: 0;
                    display: flex;
                    background: #fff; ">
            <div>
                <img id="captcha" src="" alt="">
                <div id="captcha-ssid"></div>
            </div>        

            <button id="captcha-refresh" onclick="getCaptcha()">
                <?xml version="1.0" encoding="iso-8859-1"?>
                <svg fill="#000000" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                \t viewBox="0 0 489.698 489.698" xml:space="preserve">
                <g>
                \t<g>
                \t\t<path d="M468.999,227.774c-11.4,0-20.8,8.3-20.8,19.8c-1,74.9-44.2,142.6-110.3,178.9c-99.6,54.7-216,5.6-260.6-61l62.9,13.1
                \t\t\tc10.4,2.1,21.8-4.2,23.9-15.6c2.1-10.4-4.2-21.8-15.6-23.9l-123.7-26c-7.2-1.7-26.1,3.5-23.9,22.9l15.6,124.8
                \t\t\tc1,10.4,9.4,17.7,19.8,17.7c15.5,0,21.8-11.4,20.8-22.9l-7.3-60.9c101.1,121.3,229.4,104.4,306.8,69.3
                \t\t\tc80.1-42.7,131.1-124.8,132.1-215.4C488.799,237.174,480.399,227.774,468.999,227.774z"/>
                \t\t<path d="M20.599,261.874c11.4,0,20.8-8.3,20.8-19.8c1-74.9,44.2-142.6,110.3-178.9c99.6-54.7,216-5.6,260.6,61l-62.9-13.1
                \t\t\tc-10.4-2.1-21.8,4.2-23.9,15.6c-2.1,10.4,4.2,21.8,15.6,23.9l123.8,26c7.2,1.7,26.1-3.5,23.9-22.9l-15.6-124.8
                \t\t\tc-1-10.4-9.4-17.7-19.8-17.7c-15.5,0-21.8,11.4-20.8,22.9l7.2,60.9c-101.1-121.2-229.4-104.4-306.8-69.2
                \t\t\tc-80.1,42.6-131.1,124.8-132.2,215.3C0.799,252.574,9.199,261.874,20.599,261.874z"/>
                \t</g>
                </g>
                </svg>
            </button>
        </div>
    `;
    let div = document.createElement('div');
    div.innerHTML = captcha;
    body.append(div);
    getCaptcha();

});
async function getCaptcha() {
    let res = await fetch('/api/captcha/ssid');
    let { data } = await res.json();
    document.querySelector('#captcha').src = data.picture;
    document.querySelector('#captcha-ssid').innerHTML = data.ssid;
}