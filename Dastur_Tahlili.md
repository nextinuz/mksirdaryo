# Dastur Logikasi Tahlili va Baholash

## Umumiy Ma'lumot
Bu dastur Sirdaryo viloyati uchun gazeta va jurnallarga obuna bo'lish xizmatini boshqarish uchun yaratilgan web-ilova.

---

## ✅ Ijobiy Tomonlar

### 1. **Funksional Yondashuv**
- Obuna formasi to'liq ishlaydi
- AJAX orqali dinamik ma'lumotlar yuklanadi
- Telegram bot orqali bildirishnomalar yuboriladi
- Chek (kvitansiya) generatsiya qilinadi

### 2. **Foydalanuvchi Interfeysi**
- Bootstrap 5 ishlatilgan (zamonaviy dizayn)
- Responsive dizayn
- Forma validatsiyasi mavjud
- Telefon raqami maskalash

### 3. **Ma'lumotlar Bazasi**
- MySQL ma'lumotlar bazasi ishlatilgan
- Nashrlar turi bo'yicha ajratilgan (gazeta/jurnal)

---

## ⚠️ Jiddiy Muammolar va Xavflar

### 1. **XAVFSIZLIK MUAMMOLARI** 🔴

#### a) SQL Injection Xavfi
```php
// ajaxdata.php - 9-qator
$query = "SELECT * FROM ".$_POST['nashr_turi'];
```
**Muammo:** Foydalanuvchi kiritgan ma'lumotlar to'g'ridan-to'g'ri SQL so'rovga qo'shilmoqda.

**Yechim:** Prepared statements ishlatish kerak:
```php
$stmt = $db->prepare("SELECT * FROM ? WHERE nomi = ?");
$stmt->bind_param("ss", $nashr_turi, $nashr);
```

#### b) Hardcoded Parollar
```php
// admin/index.php - 9-10 qatorlar
if($password == '123'){
    if($login == 'mk'){
```
**Muammo:** Parol va login kod ichida yozilgan. Bu juda xavfli!

**Yechim:** 
- Parollarni hash qilish (password_hash)
- Ma'lumotlar bazasida saqlash
- Session yoki JWT token ishlatish

#### c) Telegram Token Ochiq
```php
// index.php - 268-qator
$token = "5804615789:AAG2PQwll8PAmeIkXlAJjoQFSbr5eTig3PY";
```
**Muammo:** Token ochiq ko'rinib turibdi. Bu token o'g'irlanishi mumkin.

**Yechim:** Environment variables yoki config faylga alohida joylashtirish.

### 2. **Ma'lumotlar Saqlash Muammolari** 🟡

#### a) Faylga Ma'lumot Saqlash
```php
// ajaxdata.php - 12-25 qatorlar
file_put_contents('nashr_turi.txt', $_POST['nashr_turi']);
file_put_contents('narx.txt', $row['butun']);
```
**Muammo:** 
- Ko'p foydalanuvchilar bir vaqtda ishlatganda muammo bo'lishi mumkin
- Fayllar o'chib ketishi yoki buzilishi mumkin
- Concurrent access muammolari

**Yechim:** Ma'lumotlarni session yoki ma'lumotlar bazasida saqlash.

#### b) Session Muammosi
```php
// index.php - 231-250 qatorlar
if (!isset($_SESSION['visited'])) {
    $user_count = file_get_contents('user_count.txt');
    $user_count++;
    file_put_contents('user_count.txt', $user_count);
}
```
**Muammo:** 
- Har bir yangi session = yangi foydalanuvchi (noto'g'ri)
- Faylga yozish sekin va xavfli

**Yechim:** 
- IP yoki cookie orqali aniqlash
- Ma'lumotlar bazasida saqlash

### 3. **Kod Sifati Muammolari** 🟡

#### a) Kod Takrorlanishi
```javascript
// main.js - 32-137 qatorlar
// Har bir tuman uchun bir xil kod takrorlanadi
```
**Yechim:** Funksiya yaratish:
```javascript
function populateMFY(tuman, array) {
    var selectField = document.getElementById("oblact");
    selectField.options.length = 0;
    for (i=0; i<array.length; i++) {
        selectField.options[selectField.length] = new Option(array[i], array[i]);
    }
}
```

#### b) HTML va PHP Aralashmasi
```php
// index.php - 230-254 qatorlar
// PHP kodi HTML ichida, footer dan keyin
```
**Muammo:** Kod tartibsiz va qiyin o'qiladi.

**Yechim:** 
- PHP logikani alohida fayllarga ajratish
- MVC pattern ishlatish

#### c) Xatolar Boshqaruvi Yo'q
```php
// ajaxdata.php
$result = $db->query($query);
// Xato tekshirilmagan
```
**Yechim:** Try-catch yoki xato tekshirish:
```php
if (!$result) {
    die("Xato: " . $db->error);
}
```

### 4. **Ma'lumotlar Validatsiyasi** 🟡

#### a) Input Sanitization Yo'q
```php
// chek.php - 417-428 qatorlar
$hudud = $_POST['hudud'];
$mfy = $_POST['mfy'];
// Tozalash yo'q
```
**Muammo:** XSS hujumlari mumkin.

**Yechim:** 
```php
$hudud = htmlspecialchars(trim($_POST['hudud']), ENT_QUOTES, 'UTF-8');
```

#### b) Forma Validatsiyasi Yetarli Emas
```javascript
// js.js - 27-45 qatorlar
// Faqat FIO va telefon tekshiriladi
// Boshqa maydonlar tekshirilmaydi
```

### 5. **Arxitektura Muammolari** 🟡

#### a) Monolitik Struktura
- Barcha logika bir joyda
- Qayta ishlatish qiyin
- Test qilish qiyin

#### b) Config Fayl Muammosi
```php
// config.php
$host = 'MySQL-8.4'; // Noto'g'ri host nomi
$pass = ''; // Parol yo'q
```

---

## 📊 Kod Sifati Baholash

| Kategoriya | Baho | Izoh |
|------------|------|------|
| **Xavfsizlik** | 2/10 | SQL injection, hardcoded parollar, token ochiq |
| **Kod Sifati** | 4/10 | Takrorlanish, aralashma, xato boshqaruvi yo'q |
| **Arxitektura** | 3/10 | Monolitik, pattern yo'q |
| **Ma'lumotlar Boshqaruvi** | 3/10 | Faylga saqlash, concurrent muammolar |
| **Funksionallik** | 7/10 | Asosiy funksiyalar ishlaydi |
| **UX/UI** | 6/10 | Yaxshi dizayn, lekin validatsiya yetarli emas |

**Umumiy Baho: 4.2/10**

---

## 🔧 Taklif Etilgan Yaxshilanishlar

### 1. **Xavfsizlikni Yaxshilash**
- ✅ Prepared statements ishlatish
- ✅ Input sanitization va validatsiya
- ✅ Parollarni hash qilish
- ✅ CSRF token qo'shish
- ✅ Rate limiting

### 2. **Kod Sifati**
- ✅ MVC pattern ishlatish
- ✅ Funksiyalarni qayta ishlatish
- ✅ Error handling qo'shish
- ✅ Logging tizimi

### 3. **Ma'lumotlar Boshqaruvi**
- ✅ Session yoki Redis ishlatish
- ✅ Ma'lumotlar bazasida saqlash
- ✅ Cache mexanizmi

### 4. **Arxitektura**
- ✅ Alohida fayllarga ajratish (models, controllers, views)
- ✅ Config faylni yaxshilash
- ✅ Environment variables

---

## 📝 Xulosa

### Kuchli Tomonlar:
1. ✅ Asosiy funksiyalar ishlaydi
2. ✅ Zamonaviy UI/UX
3. ✅ Telegram integratsiyasi
4. ✅ Chek generatsiyasi

### Zaif Tomonlar:
1. 🔴 **Jiddiy xavfsizlik muammolari** (SQL injection, hardcoded parollar)
2. 🔴 **Ma'lumotlar saqlash muammolari** (faylga saqlash, concurrent access)
3. 🟡 **Kod sifati past** (takrorlanish, aralashma)
4. 🟡 **Xato boshqaruvi yo'q**

### Tavsiya:
Dastur ishlaydi, lekin **production muhitida ishlatishdan oldin** barcha xavfsizlik muammolarini hal qilish **majburiy**. Ayniqsa:
- SQL injection xavfini bartaraf etish
- Parol tizimini qayta yozish
- Input validatsiyasini kuchaytirish

**Daraja:** Dastur ishlaydi, lekin xavfsizlik va kod sifati jihatidan sezilarli yaxshilanish kerak.
