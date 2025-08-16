# 📦 Produk App - Laravel 10

Proyek ini adalah aplikasi manajemen produk berbasis **Laravel 10** dengan fitur:  

- **REST API** dengan Laravel Sanctum (Autentikasi Bearer Token).  
- **CRUD Produk** berbasis Web (Breeze/Jetstream).  
- **Factory & Seeder** untuk data dummy.  
- **Testing API** dengan Postman Collection.  
- **Query Scopes, Eager Loading, Sorting, Pagination, Caching.**  
- **Pencarian Produk** berdasarkan **nama** dan **kategori**.  

## 🚀 Instalasi

1. Clone repository  
   ```bash
   git clone https://github.com/username/produk-app.git
   cd produk-app
   ```

2. Install dependencies  
   ```bash
   composer install
   npm install && npm run dev
   ```

3. Copy file `.env` dan konfigurasi database  
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Migrasi database  
   ```bash
   php artisan migrate --seed
   ```

   Seeder akan membuat kategori, produk, dan user admin default.

5. Jalankan server  
   ```bash
   php artisan serve
   ```

---

## 🔑 Autentikasi API

Menggunakan **Laravel Sanctum**.  
- Login API:  
  ```http
  POST http://localhost:8000/api/login
  Content-Type: application/json

  {
    "email": "admin@example.com",
    "password": "password123"
  }
  ```

- Response:
  ```json
  {
    "message": "Login berhasil",
    "token": "1|xyz123...",
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@example.com"
    }
  }
  ```

- Gunakan token pada header Authorization:
  ```
  Authorization: Bearer {token}
  ```

---

## 📂 Struktur Utama

```
produk-app/
│
├── app/Http/Controllers/
│   ├── Api/ProdukController.php      # API Produk
│   └── ProdukWebController.php       # CRUD Produk via Web
│
├── database/
│   ├── factories/ProdukFactory.php   # Factory Produk
│   ├── seeders/DatabaseSeeder.php    # Seeder utama
│   ├── seeders/ProdukBesarSeeder.php # Seeder produk banyak
│   └── seeders/KategoriSeeder.php    # Seeder kategori
│
├── public/
│
├── resources/views/
│   ├── produk/index.blade.php        # List produk
│   ├── produk/create.blade.php       # Tambah produk
│   ├── produk/edit.blade.php         # Edit produk
│   └── layouts/app.blade.php         # Layout utama
│
├── routes/
│   ├── api.php                       # Route API
│   └── web.php                       # Route Web CRUD
│
├── tests/Feature/
│   ├── ProdukApiTest.php             # Uji API Produk
│   └── ExampleTest.php
│
└── docs/  
    └── ProdukAPI.postman_collection.json           # Koleksi Postman
```

---

## 🏭 Factory & Seeders

- **ProdukFactory.php** → membuat produk acak dengan kategori, deskripsi, dan harga.  
- **DatabaseSeeder.php** → memanggil kategori, produk, dan user admin.  
- **ProdukBesarSeeder.php** → membuat ratusan produk dummy untuk pengujian pagination & search.  

---

## 🧪 Testing API (Postman)

Gunakan koleksi Postman: **`ProdukAPI.postman_collection.json`**  

Endpoint:  

- `POST /api/login` → Login & dapatkan token  
- `GET /api/products` → List produk (pagination + search)  
  - Params: `?search=Elektronik`  
  - Params: `?sort=harga&order=asc`  
- `GET /api/products/{id}` → Detail produk  

---

## 🌐 Halaman Web (Breeze/Jetstream)

- **Login Admin** → `http://127.0.0.1:8000/login`  
  - email: `admin@example.com`  
  - password: `password123`

- **Login User** → `http://127.0.0.1:8000/login`  
  - email: `user@example.com`  
  - password: `user123`

- **Dashboard** → `http://127.0.0.1:8000/dashboard`  

- **Manajemen Produk (CRUD)**  
  - `GET /produk` → Daftar produk (dengan search & pagination)  
  - `GET /produk/create` → Form tambah produk  
  - `POST /produk` → Simpan produk baru  
  - `GET /produk/{id}/edit` → Form edit produk  
  - `PUT /produk/{id}` → Update produk  
  - `DELETE /produk/{id}` → Hapus produk  

---

## 🔍 Pencarian & Sorting

- Pencarian produk berdasarkan **nama** atau **kategori**  
  ```http
  GET /api/products?search=Buku
  ```

- Sorting berdasarkan kolom tertentu  
  ```http
  GET /api/products?sort=harga&order=desc
  ```

- Pagination default 10 produk per halaman.  

---

## ⚡ Caching

Produk API menggunakan caching bawaan Laravel:  

```php
$products = Cache::remember('products_page_'.$page, 60, function () {
    return Produk::with('kategori')->paginate(10);
});
```

Cache otomatis invalid ketika ada produk baru/update/hapus.  

---

## 🧑‍💻 Testing Feature

Jalankan PHPUnit:

```bash
php artisan test
```

Contoh `tests/Feature/ProdukApiTest.php` akan menguji:  
- Login API  
- Get Produk  
- Tambah Produk  
- Update Produk  
- Hapus Produk  

---

## 📌 Catatan

- Default admin:  
  - email: `admin@example.com`  
  - password: `password123`  
- Gunakan `php artisan migrate:fresh --seed` jika ingin reset data.  
- Pastikan Postman Authorization → `Bearer Token` diisi dengan token dari login.  

---

✍️ **Dibuat dengan Laravel 10 + Breeze + Sanctum**
