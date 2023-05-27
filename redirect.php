<?php
if (isset($_GET['url'])) {
    $encryptedUrl = urldecode($_GET['url']); // Şifreli URL'yi alıp deşifre ediyoruz
    $url = base64_decode($encryptedUrl); // Deşifre edilmiş URL'yi elde ediyoruz

    // İsteğe bağlı olarak URL'yi doğrulayabilir veya güvenlik kontrolleri yapabilirsiniz

    // Yönlendirme işlemini gerçekleştiriyoruz
    header("Location: $url");
    exit;
} else {
    // URL parametresi bulunamadığında veya geçerli değilse yönlendirme yapmıyoruz
    echo "Hedef URL bulunamadı veya geçersiz.";
}
?>
