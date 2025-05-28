<?php
// Handle AJAX request for sending message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => '6281327622374',
            'message' => 'Seseorang telah membuka flipbook special day! 💕',
        ),
        CURLOPT_HTTPHEADER => array(
            "Authorization: 9uDDcwdttS1hquTqvnmr" // Ganti dengan token yang sebenarnya
        ),
    ));
    
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        echo json_encode(['status' => 'error', 'message' => $error_msg]);
    } else {
        $response_data = json_decode($response, true);
        if ($response_data && isset($response_data['status']) && $response_data['status'] === true) {
            echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dikirim!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim pesan']);
        }
    }
    curl_close($curl);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flipbook Interaktif - Special Day</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Poppins:wght@300;400;500&family=Shadows+Into+Light&display=swap");

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 10px;
      background: linear-gradient(135deg, #f5efe6 0%, #e8dfd8 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      font-family: "Poppins", sans-serif;
      overflow-x: hidden;
    }

    .main-container {
      position: relative;
      width: 100%;
      max-width: 1000px;
      height: 85vh;
      min-height: 500px;
      max-height: 700px;
      perspective: 2000px;
    }

    .flipbook-container {
      position: relative;
      width: 100%;
      height: 100%;
      transform-style: preserve-3d;
    }

    .flipbook {
      width: 100%;
      height: 100%;
      transform-style: preserve-3d;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
    }

    .page {
      background-color: white;
      border-radius: 3px;
      background-size: cover;
      background-position: center;
      position: relative;
      transition: transform 0.5s, box-shadow 0.35s;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .page::after {
      content: "";
      position: absolute;
      top: 0;
      right: 0;
      width: 25px;
      height: 100%;
      background: linear-gradient(to left, rgba(0, 0, 0, 0.05), transparent);
    }

    .page-content {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      box-sizing: border-box;
      padding: clamp(15px, 4vw, 30px);
      position: relative;
      z-index: 2;
    }

    .cover {
      background: linear-gradient(135deg, #6d4c41 0%, #3e2723 100%);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .cover::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDYwIDYwIj4KICA8ZyBmaWxsPSJub25lIiBzdHJva2U9InJnYmEoMjU1LDI1NSwyNTUsMC4xNSkiIHN0cm9rZS13aWR0aD0iMSI+CiAgICA8cGF0aCBkPSJNMzAgMzBtLTMwIDBhMzAgMzAgMCAxIDAgNjAgMCAzMCAzMCAwIDEgMC02MCAweiIvPgogICAgPHBhdGggZD0iTTMwIDMwbTIwIDBhMjAgMjAgMCAxIDEtNDAgMCAyMCAyMCAwIDEgMSA0MCAweiIvPgogIDwvZz4KPC9zdmc+");
      opacity: 0.2;
    }

    .cover h1 {
      font-size: clamp(24px, 6vw, 48px);
      margin-bottom: 15px;
      font-family: "Dancing Script", cursive;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      letter-spacing: 1px;
      transform: translateY(-10px);
      opacity: 0;
      animation: fadeInDown 1s ease forwards 0.5s;
    }

    .cover h2 {
      font-size: clamp(14px, 3vw, 24px);
      font-weight: 300;
      letter-spacing: 2px;
      text-transform: uppercase;
      transform: translateY(10px);
      opacity: 0;
      animation: fadeInUp 1s ease forwards 0.8s;
    }

    @keyframes fadeInDown {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .photo-page {
      background-color: #fcfaf7;
      position: relative;
    }

    .photo-page::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+CjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0iI2ZjZmFmNyI+PC9yZWN0Pgo8Y2lyY2xlIGN4PSIxMCIgY3k9IjEwIiByPSIwLjUiIGZpbGw9IiNmMWU3ZGQiPjwvY2lyY2xlPgo8L3N2Zz4=");
      opacity: 0.6;
      z-index: 1;
    }

    .polaroid {
      background: white;
      padding: 12px 12px 30px 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      transform: rotate(-3deg);
      width: min(75%, 300px);
      margin: 20px auto;
      position: relative;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      z-index: 2;
    }

    .polaroid:hover {
      transform: rotate(-2deg) translateY(-5px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }

    .polaroid img {
      width: 100%;
      height: auto;
      filter: saturate(1.1) contrast(1.05);
      transition: filter 0.3s ease;
    }

    .polaroid:hover img {
      filter: saturate(1.2) contrast(1.1);
    }

    .polaroid p {
      text-align: center;
      margin-top: 12px;
      font-family: "Shadows Into Light", cursive;
      font-size: clamp(14px, 2.5vw, 20px);
      color: #444;
    }

    .tape {
      position: absolute;
      background-color: rgba(255, 255, 255, 0.7);
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      z-index: 3;
    }

    .tape-top {
      width: clamp(60px, 10vw, 100px);
      height: 25px;
      transform: rotate(-45deg);
      top: 20px;
      left: 20px;
    }

    .tape-bottom {
      width: clamp(40px, 8vw, 60px);
      height: 25px;
      transform: rotate(45deg);
      bottom: 40px;
      right: 20px;
    }

    .controls {
      position: absolute;
      bottom: -70px;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: center;
      gap: clamp(15px, 4vw, 30px);
      padding: 15px 0;
      flex-wrap: wrap;
    }

    .btn {
      padding: clamp(8px, 2vw, 12px) clamp(16px, 4vw, 24px);
      background: linear-gradient(to bottom, #8d6e63 0%, #6d4c41 100%);
      color: white;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-size: clamp(12px, 2.5vw, 16px);
      font-weight: 500;
      letter-spacing: 1px;
      transition: all 0.3s;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      display: flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
    }

    .btn:hover {
      background: linear-gradient(to bottom, #a1887f 0%, #8d6e63 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .btn:active {
      transform: translateY(0);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }

    .btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      background: linear-gradient(to bottom, #bbb 0%, #999 100%);
    }

    .btn:disabled:hover {
      transform: none;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      background: linear-gradient(to bottom, #bbb 0%, #999 100%);
    }

    .page-number {
      position: absolute;
      bottom: 15px;
      font-size: clamp(10px, 1.5vw, 12px);
      color: #888;
      font-style: italic;
    }

    .photo-frame {
      border: 12px solid white;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
      max-width: min(75%, 300px);
      margin: 15px 0;
      transform: rotate(-3deg);
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .photo-frame:hover {
      transform: rotate(-1deg) scale(1.02);
    }

    .photo-frame img {
      width: 100%;
      display: block;
      transition: transform 0.5s ease;
    }

    .photo-frame:hover img {
      transform: scale(1.05);
    }

    .turned-edge {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg,
          transparent 50%,
          rgba(0, 0, 0, 0.05) 50%);
    }

    .hard {
      background: linear-gradient(135deg, #5d4037 0%, #3e2723 100%);
      color: white;
    }

    .hard h2 {
      font-family: "Dancing Script", cursive;
      font-size: clamp(24px, 5vw, 36px);
      margin-bottom: 20px;
      text-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);
    }

    .hard p {
      font-size: clamp(14px, 2.5vw, 18px);
      font-weight: 300;
      max-width: 80%;
      line-height: 1.6;
    }

    .regular-page h2 {
      color: #5d4037;
      font-size: clamp(20px, 4vw, 32px);
      font-family: "Dancing Script", cursive;
      margin-bottom: 25px;
      position: relative;
    }

    .regular-page h2::after {
      content: "";
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: clamp(60px, 15vw, 100px);
      height: 2px;
      background: linear-gradient(to right,
          transparent,
          #8d6e63,
          transparent);
    }

    .regular-page p {
      color: #5d4037;
      font-size: clamp(12px, 2vw, 16px);
      line-height: 1.6;
      margin-top: 15px;
      font-weight: 300;
    }

    .decorative-corner {
      position: absolute;
      width: clamp(40px, 8vw, 60px);
      height: clamp(40px, 8vw, 60px);
      opacity: 0.2;
      z-index: 1;
    }

    .top-left {
      top: 20px;
      left: 20px;
      background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDYwIDYwIj4KICA8cGF0aCBkPSJNMCAwIEwzMCAwIEMzMCAwIDMwIDMwIDAgMzAgWiIgZmlsbD0iIzZkNGM0MSIvPgo8L3N2Zz4=");
    }

    .bottom-right {
      bottom: 20px;
      right: 20px;
      background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgdmlld0JveD0iMCAwIDYwIDYwIj4KICA8cGF0aCBkPSJNNjAgNjAgTDYwIDMwIEMzMCAzMCAzMCA2MCA2MCA2MCBaIiBmaWxsPSIjNmQ0YzQxIi8+Cjwvc3ZnPg==");
    }

    .turning {
      pointer-events: none;
    }

    .turning-right {
      animation: turnRight 0.6s ease-in-out;
    }

    .turning-left {
      animation: turnLeft 0.6s ease-in-out;
    }

    @keyframes turnRight {
      0% {
        transform: rotateY(0deg);
      }

      50% {
        transform: rotateY(-15deg);
      }

      100% {
        transform: rotateY(0deg);
      }
    }

    @keyframes turnLeft {
      0% {
        transform: rotateY(0deg);
      }

      50% {
        transform: rotateY(15deg);
      }

      100% {
        transform: rotateY(0deg);
      }
    }

    #flipbook:focus {
      outline: 2px solid #8d6e63;
      outline-offset: 4px;
    }

    .flipbook {
      touch-action: pan-y pinch-zoom;
      user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -webkit-touch-callout: none;
      -webkit-tap-highlight-color: transparent;
    }

    .flipbook * {
      touch-action: inherit;
      pointer-events: auto;
    }

    .page {
      touch-action: inherit;
    }

    @media (max-width: 768px) {
      .flipbook {
        cursor: pointer;
      }

      .page:active {
        background-color: rgba(0, 0, 0, 0.02);
      }
    }

    .loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #f5efe6;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .loader-inner {
      width: 50px;
      height: 50px;
      border: 3px solid #6d4c41;
      border-radius: 50%;
      border-top-color: transparent;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    .navigation-hint {
      position: absolute;
      bottom: 20px;
      font-size: clamp(10px, 1.5vw, 12px);
      color: #888;
      width: 100%;
      text-align: center;
      opacity: 0;
      animation: fadeIn 1s ease forwards 2s;
    }

    @keyframes fadeIn {
      to {
        opacity: 0.7;
      }
    }

    .ribbon {
      position: absolute;
      top: 0;
      right: 0;
      width: clamp(80px, 15vw, 120px);
      height: clamp(80px, 15vw, 120px);
      overflow: hidden;
      z-index: 3;
    }

    .ribbon::before {
      content: "Special";
      position: absolute;
      top: clamp(20px, 4vw, 30px);
      right: clamp(-20px, -4vw, -30px);
      transform: rotate(45deg);
      width: 150px;
      background: #8d6e63;
      color: white;
      text-align: center;
      font-size: clamp(10px, 2vw, 14px);
      padding: 5px 0;
      font-weight: 500;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
      body {
        padding: 5px;
      }

      .main-container {
        height: 80vh;
        min-height: 400px;
        max-height: none;
      }

      .controls {
        bottom: -60px;
        gap: 15px;
      }

      .btn {
        padding: 8px 16px;
        font-size: 14px;
      }

      .btn i {
        font-size: 12px;
      }

      .polaroid {
        width: 85%;
        padding: 8px 8px 20px 8px;
      }

      .photo-frame {
        max-width: 85%;
        border-width: 8px;
      }

      .tape-top,
      .tape-bottom {
        height: 20px;
      }

      .turned-edge {
        width: 30px;
        height: 30px;
      }

      @media (device-width: 390px) and (device-height: 844px),
      (device-width: 375px) and (device-height: 812px),
      (device-width: 360px) and (device-height: 780px) {
        .main-container {
          height: 75vh;
          min-height: 350px;
        }

        .cover h1 {
          font-size: clamp(20px, 5vw, 32px);
        }

        .cover h2 {
          font-size: clamp(12px, 2.5vw, 16px);
        }

        .polaroid {
          width: 90%;
          margin: 10px auto;
        }

        .photo-frame {
          max-width: 90%;
          border-width: 6px;
        }

        .page-content {
          padding: 10px;
        }

        .regular-page h2 {
          font-size: clamp(18px, 4vw, 24px);
        }

        .regular-page p {
          font-size: clamp(11px, 2vw, 14px);
        }

        .controls {
          bottom: -50px;
          gap: 10px;
        }

        .btn {
          padding: 6px 12px;
          font-size: 12px;
          gap: 4px;
        }
      }
    }

    @media (max-width: 768px) and (orientation: landscape) {
      .main-container {
        height: 85vh;
      }

      .cover h1 {
        font-size: clamp(20px, 5vw, 36px);
      }

      .cover h2 {
        font-size: clamp(12px, 2.5vw, 18px);
      }

      @media (device-width: 844px) and (device-height: 390px),
      (device-width: 812px) and (device-height: 375px),
      (device-width: 780px) and (device-height: 360px) {
        .main-container {
          height: 90vh;
        }

        .polaroid {
          width: 70%;
        }

        .photo-frame {
          max-width: 70%;
        }

        .controls {
          bottom: -40px;
        }
      }
    }

    .music-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 10000;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .music-modal.active {
      opacity: 1;
      visibility: visible;
    }

    .modal-content {
      background: white;
      padding: 30px;
      border-radius: 15px;
      text-align: center;
      max-width: 90%;
      width: 400px;
      transform: translateY(-20px);
      transition: transform 0.3s ease;
    }

    .music-modal.active .modal-content {
      transform: translateY(0);
    }

    .modal-content h2 {
      color: #5d4037;
      font-family: "Dancing Script", cursive;
      font-size: 24px;
      margin-bottom: 20px;
    }

    .modal-content p {
      color: #666;
      margin-bottom: 25px;
      line-height: 1.6;
    }

    .modal-btn {
      background: linear-gradient(to bottom, #8d6e63 0%, #6d4c41 100%);
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .modal-btn:hover {
      background: linear-gradient(to bottom, #a1887f 0%, #8d6e63 100%);
      transform: translateY(-2px);
    }

    .music-player {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: white;
      padding: 15px;
      border-radius: 50px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      display: flex;
      align-items: center;
      gap: 15px;
      z-index: 1000;
      transform: translateY(100px);
      opacity: 0;
      transition: all 0.3s ease;
    }

    .music-player.active {
      transform: translateY(0);
      opacity: 1;
    }

    .music-control {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(135deg, #8d6e63 0%, #6d4c41 100%);
      border: none;
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .music-control:hover {
      transform: scale(1.1);
    }

    .music-control i {
      font-size: 18px;
    }

    .music-info {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .music-title {
      font-size: 14px;
      color: #5d4037;
      font-weight: 500;
    }

    .music-artist {
      font-size: 12px;
      color: #888;
    }

    @media (max-width: 768px) {
      .modal-content {
        padding: 20px;
        width: 85%;
      }

      .modal-content h2 {
        font-size: 20px;
      }

      .modal-btn {
        padding: 10px 25px;
        font-size: 14px;
      }

      .music-player {
        bottom: 10px;
        right: 10px;
        padding: 10px;
      }

      .music-control {
        width: 35px;
        height: 35px;
      }

      .music-title {
        font-size: 12px;
      }

      .music-artist {
        font-size: 10px;
      }
    }

    .loading {
      opacity: 0.7;
      pointer-events: none;
    }

    .loading i {
      animation: spin 1s linear infinite;
    }
  </style>
</head>

<body>
  <div class="loader">
    <div class="loader-inner"></div>
  </div>

  <!-- Music Modal -->
  <div class="music-modal" id="musicModal">
    <div class="modal-content">
      <h2>Welcome to Our Story</h2>
      <p>
        Would you like to play background music while browsing through our
        memories?
      </p>
      <button class="modal-btn" id="playMusicBtn">
        <i class="fas fa-music"></i>
        Play Music
      </button>
    </div>
  </div>

  <!-- Music Player -->
  <div class="music-player" id="musicPlayer">
    <button class="music-control" id="musicControl">
      <i class="fas fa-