<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha - APAMS</title>
    <style>
        * {
            color: #fff;
            font-family: sans-serif;
        }
        .block-set {
            width: 35rem;
            height: 27rem;
            background-color: #eb7c15;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='470' height='391.7' viewBox='0 0 1080 900'%3E%3Cg fill-opacity='0.03'%3E%3Cpolygon fill='%23444' points='90 150 0 300 180 300'/%3E%3Cpolygon points='90 150 180 0 0 0'/%3E%3Cpolygon fill='%23AAA' points='270 150 360 0 180 0'/%3E%3Cpolygon fill='%23DDD' points='450 150 360 300 540 300'/%3E%3Cpolygon fill='%23999' points='450 150 540 0 360 0'/%3E%3Cpolygon points='630 150 540 300 720 300'/%3E%3Cpolygon fill='%23DDD' points='630 150 720 0 540 0'/%3E%3Cpolygon fill='%23444' points='810 150 720 300 900 300'/%3E%3Cpolygon fill='%23FFF' points='810 150 900 0 720 0'/%3E%3Cpolygon fill='%23DDD' points='990 150 900 300 1080 300'/%3E%3Cpolygon fill='%23444' points='990 150 1080 0 900 0'/%3E%3Cpolygon fill='%23DDD' points='90 450 0 600 180 600'/%3E%3Cpolygon points='90 450 180 300 0 300'/%3E%3Cpolygon fill='%23666' points='270 450 180 600 360 600'/%3E%3Cpolygon fill='%23AAA' points='270 450 360 300 180 300'/%3E%3Cpolygon fill='%23DDD' points='450 450 360 600 540 600'/%3E%3Cpolygon fill='%23999' points='450 450 540 300 360 300'/%3E%3Cpolygon fill='%23999' points='630 450 540 600 720 600'/%3E%3Cpolygon fill='%23FFF' points='630 450 720 300 540 300'/%3E%3Cpolygon points='810 450 720 600 900 600'/%3E%3Cpolygon fill='%23DDD' points='810 450 900 300 720 300'/%3E%3Cpolygon fill='%23AAA' points='990 450 900 600 1080 600'/%3E%3Cpolygon fill='%23444' points='990 450 1080 300 900 300'/%3E%3Cpolygon fill='%23222' points='90 750 0 900 180 900'/%3E%3Cpolygon points='270 750 180 900 360 900'/%3E%3Cpolygon fill='%23DDD' points='270 750 360 600 180 600'/%3E%3Cpolygon points='450 750 540 600 360 600'/%3E%3Cpolygon points='630 750 540 900 720 900'/%3E%3Cpolygon fill='%23444' points='630 750 720 600 540 600'/%3E%3Cpolygon fill='%23AAA' points='810 750 720 900 900 900'/%3E%3Cpolygon fill='%23666' points='810 750 900 600 720 600'/%3E%3Cpolygon fill='%23999' points='990 750 900 900 1080 900'/%3E%3Cpolygon fill='%23999' points='180 0 90 150 270 150'/%3E%3Cpolygon fill='%23444' points='360 0 270 150 450 150'/%3E%3Cpolygon fill='%23FFF' points='540 0 450 150 630 150'/%3E%3Cpolygon points='900 0 810 150 990 150'/%3E%3Cpolygon fill='%23222' points='0 300 -90 450 90 450'/%3E%3Cpolygon fill='%23FFF' points='0 300 90 150 -90 150'/%3E%3Cpolygon fill='%23FFF' points='180 300 90 450 270 450'/%3E%3Cpolygon fill='%23666' points='180 300 270 150 90 150'/%3E%3Cpolygon fill='%23222' points='360 300 270 450 450 450'/%3E%3Cpolygon fill='%23FFF' points='360 300 450 150 270 150'/%3E%3Cpolygon fill='%23444' points='540 300 450 450 630 450'/%3E%3Cpolygon fill='%23222' points='540 300 630 150 450 150'/%3E%3Cpolygon fill='%23AAA' points='720 300 630 450 810 450'/%3E%3Cpolygon fill='%23666' points='720 300 810 150 630 150'/%3E%3Cpolygon fill='%23FFF' points='900 300 810 450 990 450'/%3E%3Cpolygon fill='%23999' points='900 300 990 150 810 150'/%3E%3Cpolygon points='0 600 -90 750 90 750'/%3E%3Cpolygon fill='%23666' points='0 600 90 450 -90 450'/%3E%3Cpolygon fill='%23AAA' points='180 600 90 750 270 750'/%3E%3Cpolygon fill='%23444' points='180 600 270 450 90 450'/%3E%3Cpolygon fill='%23444' points='360 600 270 750 450 750'/%3E%3Cpolygon fill='%23999' points='360 600 450 450 270 450'/%3E%3Cpolygon fill='%23666' points='540 600 630 450 450 450'/%3E%3Cpolygon fill='%23222' points='720 600 630 750 810 750'/%3E%3Cpolygon fill='%23FFF' points='900 600 810 750 990 750'/%3E%3Cpolygon fill='%23222' points='900 600 990 450 810 450'/%3E%3Cpolygon fill='%23DDD' points='0 900 90 750 -90 750'/%3E%3Cpolygon fill='%23444' points='180 900 270 750 90 750'/%3E%3Cpolygon fill='%23FFF' points='360 900 450 750 270 750'/%3E%3Cpolygon fill='%23AAA' points='540 900 630 750 450 750'/%3E%3Cpolygon fill='%23FFF' points='720 900 810 750 630 750'/%3E%3Cpolygon fill='%23222' points='900 900 990 750 810 750'/%3E%3Cpolygon fill='%23222' points='1080 300 990 450 1170 450'/%3E%3Cpolygon fill='%23FFF' points='1080 300 1170 150 990 150'/%3E%3Cpolygon points='1080 600 990 750 1170 750'/%3E%3Cpolygon fill='%23666' points='1080 600 1170 450 990 450'/%3E%3Cpolygon fill='%23DDD' points='1080 900 1170 750 990 750'/%3E%3C/g%3E%3C/svg%3E");
        }
        .block-set {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
        }
        .block-set .blockets:first-child{
            width: 50%;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
        }
        .block-set .blockets:nth-child(2){
            text-align: center;
            border: 4px solid;
            border-color: #fff;
            border-radius: 1rem;
            padding: 0.6rem;
        }
        .block-set .blockets:last-child{
            padding: 1rem;
            background-color: #fff;
            border-radius: 100%;
        }
        .block-set .blockets svg {
            height: 5rem;
            width: 5rem;
        }
    </style>
</head>
<body>
    <div class="block-set">
        <div class="blockets">
            <div>
                <?xml version="1.0" encoding="iso-8859-1"?><!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  --><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#FFC850;" d="M444.379,3.741c10.828-8.798,27.018-1.092,27.018,12.859v222.01l-182.26-107.699L444.379,3.741z"/><path style="fill:#EBAF4B;" d="M454.828,228.819l-110.973-65.574l92.462-104.241c6.465-7.288,18.511-2.716,18.511,7.027V228.819z"/><path style="fill:#FFC850;" d="M67.619,3.741C56.79-5.057,40.601,2.649,40.601,16.6v222.01l182.26-107.699L67.619,3.741z"/><path style="fill:#EBAF4B;" d="M57.17,228.819l110.973-65.574L75.681,59.004c-6.465-7.288-18.511-2.716-18.511,7.027	C57.17,66.031,57.17,228.819,57.17,228.819z"/><ellipse style="fill:#FFDC64;" cx="255.999" cy="292.46" rx="231.97" ry="219.54"/><path style="fill:#FF8087;" d="M289.137,429.155v16.569c0,18.302-14.836,33.138-33.138,33.138l0,0	c-18.302,0-33.138-14.836-33.138-33.138v-16.569l33.138-16.569L289.137,429.155z"/><path style="fill:#5D5360;" d="M274.293,343.862h-36.588c-7.899,0-12.273,9.157-7.307,15.3l18.295,22.634	c3.76,4.651,10.852,4.651,14.613,0l18.295-22.634C286.566,353.019,282.193,343.862,274.293,343.862z"/><g>	<path style="fill:#E1A546;" d="M479.673,437.439c-1.286,0-2.593-0.299-3.815-0.934c-50.092-26.047-128.491-41.524-129.28-41.678		c-4.49-0.874-7.419-5.226-6.545-9.717c0.878-4.494,5.186-7.427,9.717-6.545c3.301,0.643,81.515,16.076,133.754,43.239		c4.057,2.112,5.639,7.111,3.527,11.173C485.555,435.813,482.667,437.439,479.673,437.439z"/>	<path style="fill:#E1A546;" d="M496.255,379.451c-0.712,0-1.436-0.093-2.156-0.287c-46.435-12.483-130.87-10.113-131.703-10.077		c-4.652,0.134-8.398-3.459-8.531-8.03c-0.138-4.575,3.459-8.394,8.03-8.531c3.56-0.113,87.736-2.476,136.509,10.635		c4.417,1.189,7.035,5.732,5.849,10.153C503.257,377.012,499.912,379.447,496.255,379.451z"/></g><path style="fill:#FFC850;" d="M313.991,495.431c-128.112,0-231.967-98.291-231.967-219.54c0-89.035,56.034-165.634,136.518-200.081	C108.248,92.762,24.032,183.285,24.032,292.46C24.032,413.709,127.887,512,255.999,512c34.037,0,66.328-6.995,95.449-19.459	C339.25,494.416,326.748,495.431,313.991,495.431z"/><g>	<path style="fill:#E1A546;" d="M32.324,437.439c-2.993,0-5.882-1.622-7.358-4.462c-2.112-4.061-0.53-9.061,3.527-11.173		c52.24-27.163,130.453-42.596,133.754-43.239c4.494-0.902,8.839,2.055,9.717,6.545c0.874,4.49-2.055,8.843-6.545,9.717		c-0.789,0.154-79.189,15.631-129.28,41.678C34.917,437.14,33.611,437.439,32.324,437.439z"/>	<path style="fill:#E1A546;" d="M15.743,379.451c-3.657,0-7.002-2.439-7.997-6.137c-1.185-4.421,1.432-8.964,5.849-10.153		c48.777-13.115,132.941-10.736,136.509-10.635c4.571,0.138,8.167,3.956,8.03,8.531c-0.138,4.571-4.098,8.196-8.531,8.03		c-0.849-0.028-85.297-2.407-131.703,10.077C17.179,379.358,16.455,379.451,15.743,379.451z"/></g><path style="fill:#4B3F4E;" d="M160.727,321.456L160.727,321.456c-15.948,0-28.996-13.048-28.996-28.996v-16.569	c0-15.948,13.048-28.996,28.996-28.996l0,0c15.948,0,28.996,13.048,28.996,28.996v16.569	C189.723,308.407,176.675,321.456,160.727,321.456z"/><path style="fill:#5D5360;" d="M160.727,246.895c-1.418,0-2.778,0.221-4.142,0.421v41.002c0,9.151,7.418,16.569,16.569,16.569	s16.569-7.418,16.569-16.569v-12.427C189.723,259.943,176.674,246.895,160.727,246.895z"/><circle style="fill:#FFFFFF;" cx="160.729" cy="267.61" r="12.427"/><path style="fill:#4B3F4E;" d="M351.271,321.456L351.271,321.456c-15.948,0-28.996-13.048-28.996-28.996v-16.569	c0-15.948,13.048-28.996,28.996-28.996l0,0c15.948,0,28.996,13.048,28.996,28.996v16.569	C380.267,308.407,367.219,321.456,351.271,321.456z"/><path style="fill:#5D5360;" d="M351.271,246.895c-1.418,0-2.778,0.221-4.142,0.421v41.002c0,9.151,7.418,16.569,16.569,16.569	s16.569-7.418,16.569-16.569v-12.427C380.267,259.943,367.219,246.895,351.271,246.895z"/><circle style="fill:#FFFFFF;" cx="351.269" cy="267.61" r="12.427"/><path style="fill:#4B3F4E;" d="M262.408,382.15l-18.295-36.215c-0.332-0.658-0.518-1.378-0.769-2.074h-5.639	c-7.899,0-12.273,9.157-7.308,15.3l18.295,22.634c3.55,4.39,9.981,4.485,13.863,0.587	C262.511,382.297,262.453,382.239,262.408,382.15z"/><path style="fill:#E6646E;" d="M255.999,412.586l-33.138,16.569v16.569c0,2.629,0.383,5.154,0.961,7.606	c8.337-1.034,16.389-3.449,23.892-7.153v7.831c0,4.575,3.709,8.285,8.285,8.285c4.576,0,8.285-3.709,8.285-8.285v-7.83	c7.504,3.704,15.556,6.119,23.892,7.152c0.578-2.452,0.961-4.978,0.961-7.606v-16.569L255.999,412.586z"/><path style="fill:#EBAF4B;" d="M297.422,437.439c-11.719,0-23.013-3.483-32.653-10.073c-5.162-3.527-12.374-3.527-17.544,0	c-9.636,6.59-20.93,10.073-32.649,10.073c-14.259,0-27.993-5.275-38.672-14.85c-3.406-3.058-3.689-8.297-0.635-11.703	s8.281-3.689,11.703-0.635c13.911,12.483,35.683,13.847,50.905,3.434c10.841-7.403,25.408-7.403,36.241,0	c15.226,10.408,37.001,9.041,50.913-3.43c3.402-3.05,8.636-2.775,11.699,0.639c3.054,3.406,2.767,8.645-0.639,11.699	C325.41,432.168,311.681,437.439,297.422,437.439z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
            </div>
            <div>
                <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m176.278 50.544c-5.145 1.842-126.152 46.183-137.829 139.596-1.29 10.316-2.604 22.446-3.995 35.288-3.709 34.229-7.913 73.025-13.287 93.314-2.96 11.174-5.944 20.174-8.83 28.877-6.62 19.963-12.337 37.204-12.337 66.214 0 25.876 10.197 50.398 28.715 69.049 18.641 18.777 43.306 29.118 69.452 29.118 54.129 0 98.166-44.037 98.166-98.167z" fill="#c97840"/><path d="m335.722 50.544c5.145 1.842 126.152 46.182 137.829 139.595 1.29 10.316 2.604 22.446 3.995 35.288 3.709 34.229 7.913 73.025 13.287 93.314 2.96 11.174 5.944 20.174 8.83 28.877 6.62 19.964 12.337 37.205 12.337 66.215 0 25.876-10.197 50.398-28.715 69.049-18.641 18.777-43.307 29.118-69.452 29.118-54.129 0-98.166-44.037-98.166-98.167z" fill="#ae632c"/><g><path d="m423.28 167.097c0-43.692-17.392-85.312-48.971-117.192-31.876-32.181-73.889-49.903-118.309-49.905l-10.667 223.999 10.667 197.874c12.238 12.515 29.109 19.795 47.248 19.794.113 0 .23 0 .343-.001 17.188-.087 33.593-6.572 46.195-18.259 12.603-11.688 20.303-27.56 21.683-44.692l1.749-27.909 32.034-78.085.108-.274c18.571-47.927 18.12-87.965 17.92-105.35z" fill="#ffa73c"/><path d="m255.995 0c-44.412 0-86.427 17.723-118.305 49.905-31.579 31.88-48.971 73.5-48.971 117.192-.2 17.385-.65 57.423 17.92 105.35l32.143 78.358 1.73 27.642.019.267c1.38 17.132 9.08 33.004 21.683 44.692s29.008 18.172 46.196 18.259c.114.001.227.001.342.001 18.137-.001 35.011-7.28 47.248-19.794v-421.872c-.002 0-.003 0-.005 0z" fill="#fdc661"/></g><path d="m158.474 195.665h30v30h-30z" fill="#351a0a"/><g><path d="m323.526 195.665h30v30h-30z" fill="#281408"/></g><g><path d="m268.146 300.722h-12.146l-13.173 35.642 13.173 58.303 32.624-20.013c11.988-7.193 19.324-20.149 19.324-34.13 0-21.982-17.82-39.802-39.802-39.802z" fill="#281408"/><path d="m243.854 300.722c-21.982 0-39.802 17.82-39.802 39.802 0 13.981 7.335 26.937 19.324 34.13l32.624 20.013v-93.944h-12.146z" fill="#412816"/></g></g></svg>
            </div>
        </div>
        <div class="blockets">
            <p>Olá, usuário.</p>
            <p>Obrigado por fazer parte da família APAMS.</p>
            <p>Abaixo segue a nova senha para acesso.</p>
            <p><b>Senha:</b> asd12as1d</p>
        </div>
        <div class="blockets">
            <img src="{{ asset('/img/logo.png') }}" alt="Logo APAMS" height="60px">
        </div>
    </div>
</body>
</html>