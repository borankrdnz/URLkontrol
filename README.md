# URL Kontrol ve Yönlendirme Aracı

Bu proje, kullanıcının girdiği bir URL'nin güvenli olup olmadığını kontrol eden, SSL sertifikası var mı diye denetleyen ve VirusTotal API'sini kullanarak URL'yi tarayan bir web uygulamasını içerir. Kontrol sonuçlarına göre kullanıcıya bilgi verir ve yönlendirme seçenekleri sunar. Ayrıca, kontrolün logunu kaydeder ve belirli bir süre sonra log dosyasını temizler.

## Özellikler

- Kullanıcı, bir URL girmek için bir giriş alanı kullanabilir.
- Girdi alanı, URL formatına uymayan girişler için doğrulama yapar.
- URL'nin SSL sertifikası kontrol edilir.
- URL, VirusTotal API'si kullanılarak taranır.
- Kullanıcıya güvenlik durumu ve yönlendirme seçenekleri sunulur.
- Kontrolün logu kaydedilir ve belirli bir süre sonra otomatik olarak temizlenir.

## Kullanılan Teknolojiler

- HTML
- CSS
- JavaScript
- PHP
- Bootstrap (CSS ve JavaScript kütüphanesi)
- Google reCAPTCHA API'si
- VirusTotal API'si

## Nasıl Kullanılır?

1. İndirilen dosyaları bir sunucuya veya web sunucusuna yükleyin.
2. `index.html` dosyasını açın.
3. URL giriş alanına kontrol etmek istediğiniz web sitesinin URL'sini girin.
4. "Kontrol Et" düğmesine tıklayın.
5. Kontrol sonuçları sayfada görüntülenecektir.
6. İstenirse, "Yönlendir" düğmesine tıklayarak web sitesine yönlendirilebilir.

## Notlar

- Bu proje, güvenlik kontrolü yapmak ve kullanıcıları zararlı web sitelerine karşı korumak amacıyla oluşturulmuştur.
- VirusTotal API'sini kullanabilmek için bir API anahtarına ihtiyacınız vardır. Kendi API anahtarınızı edinerek veya ücretsiz bir API anahtarı alarak bu projeyi kullanabilirsiniz.
- Log dosyası, kontrol kayıtlarını saklamak için kullanılır ve güvenlik analizi ve incelemeler için değerli bilgiler sağlayabilir. Belirli bir süre sonra log dosyasının temizlenmesi önerilir.
- Bu proje örnek amacıyla oluşturulmuştur ve özelleştirilmeye açıktır. İhtiyaçlarınıza göre geliştirme yapabilir ve özellikleri genişletebilirsiniz.

## Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasını inceleyebilirsiniz.

---

Bu proje [GitHub](https://github.com) üzerinde barındırılmaktadır. Daha fazla bilgi için [proje deposuna](https://github.com/borankrdnz/URLkontrol) göz atabilirsiniz.
