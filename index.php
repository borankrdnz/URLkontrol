<!DOCTYPE html>
<html>
<head>
    <title>URL Kontrol ve Yönlendirme Aracı - Boran KARADENİZ</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="URL Kontrol ve Yönlendirme Aracı olarak kullanabileceğiniz bu alan virustotal ve guvenlik taraması yapmaktadır.">
    <link rel="icon" type="image/x-icon" href="https://borankaradeniz.com/multitv/favicon.png">
<meta name="author" content="Boran KARADENİZ">
<meta name="robots" content="index, follow">
<meta property="og:title" content="URL Kontrol ve Yönlendirme Aracı - Boran KARADENİZ">
<meta property="og:description" content="URL Kontrol ve Yönlendirme Aracı olarak kullanabileceğiniz bu alan virustotal ve guvenlik taraması yapmaktadır.">
<meta property="og:image" content="https://i.ibb.co/xX8mPXt/url-kontrol.png">
<meta property="og:url" content="https://borankaradeniz.com/yonlendirme/">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="URL Kontrol ve Yönlendirme Aracı - Boran KARADENİZ">
<meta name="twitter:description" content="URL Kontrol ve Yönlendirme Aracı olarak kullanabileceğiniz bu alan virustotal ve guvenlik taraması yapmaktadır.">
<meta name="twitter:image" content="https://i.ibb.co/xX8mPXt/url-kontrol.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1f2024;
            color: #ffffff;
            padding-top: 100px;
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px 0;
            background-color: #1f2024;
            color: #ffffff;
            text-align: center;
        }

        .safe {
            color: #2ecc71;
            font-weight: bold;
        }

        .unsafe {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .logo {
            display: inline-block;
            margin-right: 10px;
            vertical-align: middle;
        }
        
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
        
        .form-control {
            height: 50px;
            font-size: 18px;
            border-radius: 0;
            border-color: #ea4335;
            color: #1f2024;
        }
        
        .btn {
            background-color: #ea4335;
            border-color: #ea4335;
        }
        
        .error-message {
            color: #ea4335;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .hidden {
            display: none;
        }
        
        .btn-icon {
            font-weight: bold;
        }
        
        .footer-text {
            margin-top: 10px;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function enableButton() {
            document.getElementById("submit-button").disabled = false;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="https://borankaradeniz.com">
                    <img src="https://borankaradeniz.com/wp-content/uploads/2023/01/borankaradeniz-logo-2.png" alt="Boran Karadeniz Logo" width="200" height="70" class="logo">
                </a>
            </div>
        </div>
                    <h2>URL Kontrol ve Yönlendirme Aracı</h2>
                    <p style="color: #e74c3c;">Gireceğiniz URL <b>https://</b> veya <b>http://</b> ile başlamalıdır.</p>

        <div class="row">
            <div class="col">
                <?php
                    // Virustotal API anahtarınızı buraya ekleyin
                    $virustotal_api_key = 'BURAYA API KEY EKLEYİN';

                    // Fonksiyon ve değişkenlerin tanımlanması
                    function checkSSL($url) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_NOBODY => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ]);
    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);

    if ($response !== false && $info['http_code'] == 200) {
        return true; // Geçerli bir SSL sertifikası var
    } else {
        return false; // Geçerli bir SSL sertifikası yok
    }
}
                    function scanWithVirusTotal($url) {
                        global $virustotal_api_key;

                        $ch = curl_init();
                        $endpoint = "https://www.virustotal.com/vtapi/v2/url/scan";
                        $params = array(
                            'apikey' => $virustotal_api_key,
                            'url' => $url
                        );

                        curl_setopt_array($ch, [
                            CURLOPT_URL => $endpoint,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $params,
                            CURLOPT_RETURNTRANSFER => true
                        ]);

                        $response = curl_exec($ch);
                        curl_close($ch);

                        return $response;
                    }

                    function getReportFromVirusTotal($url) {
                        global $virustotal_api_key;

                        $ch = curl_init();
                        $endpoint = "https://www.virustotal.com/vtapi/v2/url/report";
                        $params = array(
                            'apikey' => $virustotal_api_key,
                            'resource' => $url
                        );

                        curl_setopt($ch, CURLOPT_URL, $endpoint . '?' . http_build_query($params));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = curl_exec($ch);
                        curl_close($ch);

                        return $response;
                    }

                    $error = false;
                    $isSecure = false;
                    $virustotal_result = '';

                    if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET['url'])) {
                        $url = $_GET['url'];
                        $encrypted_url = base64_encode($url);

                        // Güvenlik kontrolü yapılır
                        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                            $error = true;
                        } else {
                            $isSecure = checkSSL($url);

                            // Virustotal ile tarama yapılır
                            $virustotal_result = getReportFromVirusTotal($url);

                            if ($virustotal_result) {
                                $virustotal_result = json_decode($virustotal_result, true);

                                if ($virustotal_result['response_code'] == 1) {
                                    $positives = $virustotal_result['positives'];
                                    if ($positives > 0) {
                                        $isSecure = false;
                                    }
                                }
                            }
                        }
                    }
                ?>
<?php
// Log dosyası için gerekli bilgiler
$logDosyasi = 'log.txt';
$kontrolTarihi = date('Y-m-d H:i:s');
$kontrolYapilanKonum = getSehir($_SERVER['REMOTE_ADDR']);
$kontrolEttigiURL = isset($_GET['url']) ? $_GET['url'] : '';
$ipAdresi = $_SERVER['REMOTE_ADDR'];
$internetServisSaglayici = getISP($_SERVER['REMOTE_ADDR']);

// ISP bilgisini almak için bir fonksiyon
function getISP($ipAdresi) {
    $json = file_get_contents("https://ipapi.co/{$ipAdresi}/json/");
    $data = json_decode($json, true);
    $isp = isset($data['org']) ? $data['org'] : 'Bilinmiyor';

    return $isp;
}

// Konumun şehir adını almak için bir fonksiyon
function getSehir($ipAdresi) {
    $json = file_get_contents("https://ipapi.co/{$ipAdresi}/json/");
    $data = json_decode($json, true);
    $sehir = isset($data['city']) ? $data['city'] : 'Bilinmiyor';

    return $sehir;
}

// Log kaydetme fonksiyonu
function logKaydet($logDosyasi, $kontrolTarihi, $kontrolYapilanKonum, $kontrolEttigiURL, $ipAdresi, $internetServisSaglayici) {
    if (!empty($kontrolEttigiURL)) {
        $log = "Kontrol Tarihi: " . $kontrolTarihi . "\n";
        $log .= "Kontrol Yapılan Konum: " . $kontrolYapilanKonum . "\n";
        $log .= "Kontrol Ettiği URL: " . $kontrolEttigiURL . "\n";
        $log .= "IP Adresi: " . $ipAdresi . "\n";
        $log .= "İnternet Servis Sağlayıcısı: " . $internetServisSaglayici . "\n\n";

        file_put_contents($logDosyasi, $log, FILE_APPEND);
    }
}

// Log dosyasını temizleme fonksiyonu
function logDosyasiniTemizle($logDosyasi) {
    if (file_exists($logDosyasi) && is_writable($logDosyasi)) {
        $dosyaTarihi = filemtime($logDosyasi);
        $gecerliZaman = time();
        $gecerliZamanFarki = 30 * 24 * 60 * 60; // 30 gün

        if (($gecerliZaman - $dosyaTarihi) >= $gecerliZamanFarki) {
            file_put_contents($logDosyasi, '');
        }
    }
}

// Log kaydetme işlemini gerçekleştir
logKaydet($logDosyasi, $kontrolTarihi, $kontrolYapilanKonum, $kontrolEttigiURL, $ipAdresi, $internetServisSaglayici);

// Log dosyasını temizle
logDosyasiniTemizle($logDosyasi);

// Diğer PHP kodları devam ediyor...
?>
<?php
if ($error) {
    echo '<div class="error-message">Geçersiz hedef URL.</div>';
} elseif ($isSecure) {
    echo '<h1><span class="safe">Bu sayfa güvenli</span></h1>';
    echo '<p>Sayfa SSL bağlantısına sahip ve virüs taraması yapıldı.</p>';
    echo '<meta http-equiv="refresh" content="10;URL=' . $url . '">';
} elseif (!$isSecure && isset($url)) {
    if ($virustotal_result && $virustotal_result['response_code'] == 1) {
        echo '<h1><span class="unsafe">Bu sayfa SSL bağlantısına sahip ancak VirusTotal\'de pozitif uyarı verildi.</span></h1>';
        echo '<p>Sayfa SSL bağlantısına sahip ancak VirusTotal\'de pozitif uyarı verildi. Yine de ziyaret etmek istiyor musunuz?</p>';

        $encryptedUrl = base64_encode($url); // URL'yi base64_encode ile şifreliyoruz
        $encryptedUrl = urlencode($encryptedUrl); // Şifreli URL'yi urlencode ile formatlıyoruz
        $redirectUrl = 'https://borankaradeniz.com/yonlendirme/redirect.php?url=' . $encryptedUrl; // Şifreli URL'yi yönlendirme sayfasına ekliyoruz

        echo '<a href="' . $redirectUrl . '" target="_blank" class="btn btn-danger visit-button" rel="nofollow">Yine de Ziyaret Et</a>';
    } else {
        echo '<h1><span class="unsafe">Bu sayfa SSL bağlantısı bulunamadı veya geçerli değil.</span></h1>';
        echo '<p>Sayfa SSL bağlantısı bulunamadı veya geçerli değil. Sayfa VirusTotal ile tarandı.</p>';

        $encryptedUrl = base64_encode($url); // URL'yi base64_encode ile şifreliyoruz
        $encryptedUrl = urlencode($encryptedUrl); // Şifreli URL'yi urlencode ile formatlıyoruz
        $redirectUrl = 'https://borankaradeniz.com/yonlendirme/redirect.php?url=' . $encryptedUrl; // Şifreli URL'yi yönlendirme sayfasına ekliyoruz

        echo '<a href="' . $redirectUrl . '" target="_blank" class="btn btn-danger visit-button" rel="nofollow">Yine de Ziyaret Et</a>';
    }
}
?>
            </div>
        </div>
        <?php if ($isSecure): ?>
        <div class="row mt-5">
            <div class="col">
                <h2>Sayac: <span id="countdown">10</span> saniye</h2>
                <p>İsterseniz, hemen aşağıdaki butona tıklayarak yönlendirme işlemini durdurabilirsiniz.</p>
                <button onclick="stopCountdown()" class="btn btn-danger"><i class="fa fa-stop"></i> Durdur</button>
            </div>
        </div>
        <script>
            var countdownElement = document.getElementById('countdown');
            var seconds = 10;
            var countdown;

            function stopCountdown() {
            clearInterval(countdown);
            window.stop(); // Yönlendirmeyi durdurmak için kullanılır
        }

            countdown = setInterval(function() {
                seconds--;
                countdownElement.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(countdown);
                    window.location.href = '<?php echo $url; ?>';
                }
            }, 1000);
        </script>
        <?php endif; ?>
    </div>
    <div class="footer">
        <?php if ($isSecure): ?>
            <span class="safe">Bu sayfa güvenli: <?php echo $url; ?></span>
        <?php elseif (!$isSecure && isset($url)): ?>
            <?php if ($virustotal_result && $virustotal_result['response_code'] == 1): ?>
                <span class="unsafe">Bu sayfa güvenli değil, VirusTotal'de pozitif uyarı verildi: <?php echo $url; ?></span>
            <?php else: ?>
                <span class="unsafe">Bu sayfa SSL bağlantısı bulunamadı, ancak güvenli görünüyor: <?php echo $url; ?></span>
            <?php endif; ?>
        <?php endif; ?>
        <br>
        <span class="footer-text">© <?php echo date("Y"); ?> Tüm hakları saklıdır. </span> </br>
                <span class="footer-text">Bu yazılım Boran Karadeniz tarafından hazırlanmıştır. </span></br>
<?php
// Log dosyası
$logDosyasi = 'log.txt';

// Toplam kontrol edilen URL sayısını hesaplamak için log dosyasını oku
function toplamKontrolEdilenURLSayisi($logDosyasi) {
    $logIcerik = file_get_contents($logDosyasi);
    $logSatirlar = explode("\n", $logIcerik);

    $toplamURLSayisi = 0;

    foreach ($logSatirlar as $satir) {
        if (strpos($satir, "Kontrol Ettiği URL:") !== false) {
            $toplamURLSayisi++;
        }
    }

    return $toplamURLSayisi;
}

// Toplam kontrol edilen URL sayısını al
$toplamURLSayisi = toplamKontrolEdilenURLSayisi($logDosyasi);

// Sonucu göster
echo "Toplam Kontrol Edilen URL Sayısı: " . $toplamURLSayisi;
?>
    </div>
    <div class="container form-container mt-5 <?php echo ($isSecure) ? 'hidden' : ''; ?>">
        <form action="" method="GET">
            <div class="input-group">
                <input type="text" name="url" class="form-control" placeholder="Web sitesi URL'sini girin" required>
                <button type="submit" class="btn-danger" id="submit-button" disabled><i class="fa fa-stop"></i> Kontrol Et</button>
            </div>
            <div class="g-recaptcha mt-3" data-sitekey="BURAYA GOOGLE SİTE KEY EKLEYİN" data-callback="enableButton"></div>
        </form>
    </div>
</body>
</html>
