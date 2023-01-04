<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon"  href="{{asset('imgs/vsrk circle.png')}}">

    <style class="INLINE_PEN_STYLESHEET_ID">
      body {
    width: 100vw;
    height: 100vh;
    background: #fefefe;
    color: #373737;
    margin: 0;
    padding: 0;
    background: #543093;
    background: linear-gradient(45deg, #543093 32%, #d960ae 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#543093", endColorstr="#d960ae", radientType=1 );
  }

  * {
    box-sizing: border-box;
    font-family: "Cabin", Arial, sans-serif;
  }

  .container {
    width: 600px;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%;
    margin: 0;
    position: absolute;
    background: #fefefe;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-direction: column;
    padding-bottom: 30px;
    box-shadow: 5px 10px 40px 0 rgba(0, 0, 0, 0.2);
    border-radius: 5px;
  }

  .inner-container {
    width: 100%;
  }

  svg {
    max-width: 90%;
    position: relative;
    left: 5%;
    margin: 0 auto;
  }

  .bottom {
    text-align: center;
    margin-top: 0em;
    max-width: 70%;
    position: relative;
    margin: 0 auto;
  }
  .bottom h2 {
    font-family: "Rokkitt", sans-serif;
    letter-spacing: 0.05em;
    font-size: 30px;
    line-height: 1.2;
    text-align: center;
    margin: 0 auto 0.25em;
  }
  .bottom p {
    color: #777;
    letter-spacing: 0.1em;
    font-size: 16px;
    line-height: 1.4;
    margin: 0 auto 2em;
  }

  .buttons {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    align-items: center;
  }
  .buttons button {
    padding: 10px 30px;
    font-size: 20px;
    background-color: #d960ae;
    border: 0;
    cursor: pointer;
    border-radius: 4px;
    letter-spacing: 0.1em;
    color: #ffffff;
    margin-right: 20px;
    margin-bottom: 15px;
    transition: all 0.25s ease-in-out;
  }
  .buttons button:hover {
    background-color: #cf3799;
  }
  .buttons button#cancel {
    margin-right: 0;
    color: #333;
    background-color: #eddfeb;
  }
  .buttons button#cancel:hover {
    background-color: #dbbed7;
  }
  .buttons button#go-back {
    display: none;
  }
  .buttons button:focus {
    border: none;
    outline: 0;
  }

  #blob-3,
  #blob-2,
  #mouth-happy,
  #mouth-sad,
  #eyebrow-happy-left,
  #eyebrow-happy-right,
  #eyes-laughing,
  #open-mouth,
  #tongue,
  #mouth-scared {
    display: none;
  }

  @media (max-width: 699px) {
    .container {
      width: 90%;
    }

    .bottom {
      margin-top: 1em;
      max-width: 90%;
    }
  }
  @media (max-width: 399px) {
    .container {
      padding: 20px;
    }

    .bottom h2 {
      font-size: 24px;
    }

    .buttons {
      flex-direction: column;
    }
    .buttons button {
      margin-right: 0;
    }

    svg {
      padding-top: 0;
    }
  }
  button:disabled {
    cursor: not-allowed;
    }
    </style>
 </head>

  <body>
    <div class="container">
      <div class="inner-container">
  <svg id="svg" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 484.7">
    <g id="blobs">
      <path id="blob-1" d="M535.89 290.2 C535.89 360.36 518.87 417.01 449.6 426.37 407.57 432.01 351.6 402.62 308.88 402.62 275.66 402.62 229.86 432.73 171.33 438.37 80.25 447.03 54 378.48 54 299.34 54 263.4 63.17 135.56 114.64 125.79 140.21 119.3 185.79 140.41 235.79 114.29 276.53 92.81 325.12 48.07 375.09 52.39 439.7 57.77 478.15 109.62 496.78 142.33 520.58 179.66 535.89 236.25 535.89 290.2 " fill="#eddfeb" data-original="M545.5,299c0,80.3-28.6,150.4-126.4,139.4-63.2-7.1-109.3-37.3-142.6-37.3-45.7,0-105.4,29.3-146.8,22.2-69-11.7-85.3-66.8-85.3-135.8,0-56.3,25.5-99.9,46.2-140.8,18.3-36.1,55.9-97.8,125.1-100.5,53.3-2.1,97.4,50.5,138.4,74.2,49.9,28.8,98.4-1.8,126,1.3C537.9,127.9,545.5,265.5,545.5,299Z"></path>
      <path id="blob-3" d="M55.1,300.7c0,80.3,27.4,150.4,121,139.4,60.5-7.1,104.7-37.3,136.5-37.3,43.8,0,100.9,29.3,140.5,22.2,66-11.7,81.7-66.8,81.7-135.8,0-56.3-16.2-103.6-36.1-144.5-17.6-36.1-54.9-97.4-121.2-100.1-51-2.1-100.1,53.8-139.4,77.5-47.8,28.8-94.3-1.8-120.7,1.3C62.4,129.6,55.1,267.1,55.1,300.7Z" fill="#eddfeb"></path>
    </g>
    <g id="confetti" class="confetti">
      <rect x="284" y="230.4" width="17.7" height="17.67" rx="4" ry="4" fill="#543093" style="visibility: inherit; opacity: 1;"></rect>
      <rect x="284" y="230.4" width="17.7" height="17.67" rx="4" ry="4" fill="#543093" style="visibility: inherit; opacity: 1;"></rect>
      <rect x="285.4" y="231.7" width="17.7" height="17.67" rx="4" ry="4" fill="#fff" style="visibility: inherit; opacity: 1;"></rect>
      <rect x="285.4" y="231.7" width="17.7" height="17.67" rx="4" ry="4" fill="#fff" style="visibility: inherit; opacity: 1;"></rect>
      <rect x="285.4" y="230.1" width="17.7" height="17.67" rx="4" ry="4" fill="#d960ae" style="visibility: inherit; opacity: 1;"></rect>
      <rect x="285.4" y="230.1" width="17.7" height="17.67" rx="4" ry="4" fill="#d960ae" style="visibility: inherit; opacity: 1;"></rect>
      <rect x="285.4" y="231.7" width="17.7" height="17.67" rx="4" ry="4" fill="#f3c1df" style="visibility: inherit; opacity: 1;"></rect>
      <rect x="285.4" y="231.7" width="17.7" height="17.67" rx="4" ry="4" fill="#f3c1df" style="visibility: inherit; opacity: 1;"></rect>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#543093" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="243.6" r="12" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.2" cy="243.6" r="12" fill="#fff" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.2" cy="243.6" r="12" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.2" cy="243.6" r="12" fill="none" stroke="#d960ae" stroke-miterlimit="10" stroke-width="2" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.2" cy="243.6" r="12" fill="none" stroke="#d960ae" stroke-miterlimit="10" stroke-width="2" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="295.9" cy="242.1" r="12" fill="none" stroke="#543093" stroke-miterlimit="10" stroke-width="2" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="295.9" cy="242.1" r="12" fill="none" stroke="#543093" stroke-miterlimit="10" stroke-width="2" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#d960ae" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#d960ae" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="292.9" cy="241.3" r="9.7" fill="#fff" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#d960ae" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#543093" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#d960ae" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#543093" style="visibility: inherit; opacity: 1;"></circle>
      <circle cx="294.1" cy="241.3" r="9.7" fill="#543093" style="visibility: inherit; opacity: 1;"></circle>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#f3c1df" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#543093" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#d960ae" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#f3c1df" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#fff" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#543093" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.1l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.1Z" fill="#d960ae" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.1l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.1Z" fill="#f3c1df" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#543093" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#d960ae" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#f3c1df" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.2l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.2Z" fill="#fff" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.1l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.1Z" fill="#d960ae" style="visibility: inherit; opacity: 1;"></path>
      <path d="M300.9,243.1l-3-3a1.5,1.5,0,0,1,0-2.1l3-3a2,2,0,0,0,.3-2.5,1.9,1.9,0,0,0-2.9-.3l-3.1,3.1a1.5,1.5,0,0,1-2.1,0l-3-3a2,2,0,0,0-2.5-.3,1.9,1.9,0,0,0-.3,2.9l3.1,3.1a1.5,1.5,0,0,1,0,2.1l-3,3a2,2,0,0,0-.3,2.5,1.9,1.9,0,0,0,2.9.3l3.1-3.1a1.5,1.5,0,0,1,2.1,0l3.1,3.1a1.9,1.9,0,0,0,2.9-.3A2,2,0,0,0,300.9,243.1Z" fill="#f3c1df" style="visibility: inherit; opacity: 1;"></path>
    </g>
    <g id="envelope">
      <path id="Background" d="M452.9,376.3a26.1,26.1,0,0,1-25.5,20.8H162.6a26.1,26.1,0,0,1-26-26V193.2a26.1,26.1,0,0,1,26-26H427.4a26.1,26.1,0,0,1,26,26V371.1a25.9,25.9,0,0,1-.5,5.2" fill="#d960ae" stroke="#543093" stroke-miterlimit="10" stroke-width="5"></path>
      <g id="paper-group" data-svg-origin="157.3000030517578 87.5999984741211" transform="matrix(1,0,0,1,0,0)">
        <rect id="paper" x="157.3" y="87.6" width="275.3" height="266.33" rx="26" ry="26" fill="#fff" stroke="#543093" stroke-miterlimit="10" stroke-width="5"></rect>
        <g id="face">
          <g id="mouth" data-svg-origin="271.1000061035156 206.76193237304688" transform="matrix(1,0,0,1,0,0)">
            <path id="mouth-scared" d="M275,220a18.7,18.7,0,0,1,35.9.1" fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5"></path>
            <path id="mouth-sad" d="M258.8,231.9c3.9-14.5,17.7-25.2,34-25.2s30.3,10.8,34.1,25.4" fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5"></path>
            <path id="mouth-worry" d="M271.1 218.7 C281.1 207.6 299.3 203.7 314.7 209.3 " fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5" data-original="M271.1,218.7c10-11.1,28.2-15,43.6-9.4" style="stroke: rgb(84, 48, 147); fill: none;"></path>
            <path id="mouth-happy" d="M259.3,207c3.9,14.5,17.7,25.2,34,25.2s30.3-10.8,34.1-25.4" fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5"></path>
            <g id="mouth-laughing">
              <path id="open-mouth" d="M323.8,208.3c3.9,0,6.7,3.9,5.9,7.9a37.5,37.5,0,0,1-73.5,0c-0.9-4.1,2-7.9,5.9-7.9h61.7Z" fill="#543093" opacity="0.98"></path>
              <path id="tongue" d="M293.2,241.1c6.9,0,13.1-2.3,17.3-5.9a2.1,2.1,0,0,0,.5-2.6c-3.1-5.8-9.9-9.8-17.8-9.8s-14.7,4-17.8,9.8a2.1,2.1,0,0,0,.5,2.5C280,238.8,286.2,241.1,293.2,241.1Z" fill="#d960ae" style="display: none;"></path>
            </g>
          </g>
          <g id="eye-group" data-svg-origin="216.39999389648438 133.6999969482422" transform="matrix(1,0,0,1,0,0)">
            <g id="eyes" class="eyes" style="transform: translate(3px, 6.8px);">
              <path stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" fill="#543093" id="eye-right" d="M360.2 172.8 C360.2 180.42 355.18 186.6 349 186.6 342.81 186.6 337.8 180.42 337.8 172.8 337.8 165.17 342.81 159 349 159 355.18 159 360.2 165.17 360.2 172.8 " data-original="M360.2 172.8 C360.2 180.42 355.18 186.6 349 186.6 342.81 186.6 337.8 180.42 337.8 172.8 337.8 165.17 342.81 159 349 159 355.18 159 360.2 165.17 360.2 172.8 z" style="fill: rgb(84, 48, 147); stroke: none;"></path>
              <path stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" fill="#543093" id="eye-left" d="M246.7 172.8 C246.7 180.42 241.68 186.6 235.5 186.6 229.31 186.6 224.3 180.42 224.3 172.8 224.3 165.17 229.31 159 235.5 159 241.68 159 246.7 165.17 246.7 172.8 " data-original="M246.7 172.8 C246.7 180.42 241.68 186.6 235.5 186.6 229.31 186.6 224.3 180.42 224.3 172.8 224.3 165.17 229.31 159 235.5 159 241.68 159 246.7 165.17 246.7 172.8 z" style="fill: rgb(84, 48, 147); stroke: none;"></path>         <path id="eyebrow-sad-right" d="M341.9 133.69 C344.5 139 356.7 147.79 366.2 148.39 " fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5" data-original="M341.9,133.7c2.6,5.3,14.8,14.1,24.3,14.7" data-svg-origin="341.8999938964844 133.69000244140625" transform="matrix(1,0,0,1,0,0)"></path>
              <path id="eyebrow-sad-left" d="M240.7 133.69 C238.1 139 225.89 147.79 216.39 148.39 " fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5" data-original="M240.7,133.7c-2.6,5.3-14.8,14.1-24.3,14.7" data-svg-origin="216.38999938964844 133.69000244140625" transform="matrix(1,0,0,1,0,0)"></path>

            </g>
            <g id="eyes-laughing">
       <path id="eye-laughing-right" d="M332.2,174c0-8.3,7.5-15,16.8-15s16.8,6.7,16.8,15" fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5"></path>
              <path id="eye-laughing-left" d="M218.7,174c0-8.3,7.5-15,16.8-15s16.8,6.7,16.8,15" fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5"></path>
            </g>
            <g id="eyebrows-happy">
              <path id="eyebrow-happy-right" d="M366.2,146.3c-2.6-5.3-14.8-14.1-24.3-14.7" fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5"></path>
              <path id="eyebrow-happy-left" d="M216.4,146.3c2.6-5.3,14.8-14.1,24.3-14.7" fill="none" stroke="#543093" stroke-linecap="round" stroke-miterlimit="10" stroke-width="5"></path>
            </g>
          </g>
        </g>
      </g>
      <path id="back" d="M451.9,186.7S322.4,288.2,313.4,294.1s-27,5.8-36.9,0S137.9,186.5,137.9,186.5a23.6,23.6,0,0,0-1.3,6.7V371.1a26.1,26.1,0,0,0,26,26H427.4a26,26,0,0,0,26-26V193.2C453.4,190.7,452.5,188.9,451.9,186.7Z" fill="#f3c1df" stroke="#543093" stroke-miterlimit="10" stroke-width="5"></path>
      <g id="shadow">
        <path id="shadow-3" d="M263.3,279.7s11.3-8.1,13.1-9.3c9.9-6.5,27-5.8,36.9,0,1.7,1,13.5,9.3,13.5,9.3" fill="none" stroke="#eddfeb" stroke-linejoin="bevel" stroke-width="7"></path>
        <path id="shadow-2" d="M430.2,193.3L313.4,282.2a26.1,26.1,0,0,1-36.8,0L159.8,193.3V201l116.8,90.6c7.9,5.7,26.9,6.4,37,0l116.6-90.9v-7.4Z" fill="#eddfeb"></path>
      </g>
      <path id="shadow-1" d="M425.2,381.5h-262c-14.1,0-24.2-11-24.2-24.4v13.2c0,13.4,10.1,24.3,24.2,24.3h262c12.7,1.2,23.9-8.4,25.2-19.5a42.8,42.8,0,0,0,.5-4.9V358.1a14.7,14.7,0,0,1-.5,3.9C448,373.1,437.6,381.5,425.2,381.5Z" fill="#d960ae" opacity="0.5"></path>
      <g id="Front">
        <path id="Front-2" data-name="Front" d="M139.8,381.9s127.5-99.5,136.5-105.4,27-5.8,36.9,0S449.8,382.1,449.8,382.1" fill="none" stroke="#543093" stroke-miterlimit="10" stroke-width="5"></path>
        <path id="Front-3" data-name="Front" d="M225.4,315.3s41.9-33,51-38.9,27-5.8,36.9,0S355,307.9,355,307.9" fill="#f3c1df" stroke="#543093" stroke-miterlimit="10" stroke-width="5"></path>
      </g>
    </g>
  </svg>


      <div class="bottom">
          <h2 class="title">Do you want to unsubscribe?</h2>
          <p class="subtitle">If you unsubscribe, you will stop receiving our weekly newsletter.</p>
              <div class="buttons">
                {{-- <form action="{{route('unsubscribeAjax')}}" method="post">
                    @csrf
                    <input hidden name="email" value="{{$email}}">
                    <button id="unsubscribe">Unsubscribe</button>
                </form> --}}
                <button id="unsubscribe" onclick="unsub({'email':'{{$email}}'})">Unsubscribe</button>
                  {{-- <button id="cancel">Cancel</button> --}}
              </div>
      </div>
  </div>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script>
    const unsub = ({email}) =>{
        $.ajax({
            type:'post',
            url:"{{route('unsubscribeAjax')}}",
            headers : {'X-CSRF-TOKEN' : '{{csrf_token()}}'},
            data:{email},
            beforeSend:()=>{
                $('#unsubscribe').text('waiting...')
            },
            success: (result) =>{
               if(result == 'no_result'){
                    $('#unsubscribe').text('No Email Found...').css({'background':'#ff0000'})
               }
               else if(result == 'success'){
                    $('#unsubscribe').attr('disabled','disabled').text('Unsubscribed sucessfully..').css({'background':'#219900'})
               }
            }
        })
    }
  </script>

  </body></html>
