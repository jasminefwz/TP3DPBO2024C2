# TP3DPBO2024C2

## Janji
Saya Jasmine Noor Fawzia [2200598] mengerjakan soal TP3 dalam Mata Kuliah DPBO untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan Aamiin

## Desain Program
**1. config/db.php**

File ini berisi konfigurasi untuk koneksi database. Terdapat variabel-variabel seperti $DB_HOST, $DB_USERNAME, $DB_PASSWORD, dan $DB_NAME yang digunakan untuk menyimpan informasi koneksi ke database MySQL.

**2. classes/DB.php**

Kelas yang bertanggung jawab untuk mengelola koneksi ke database dan eksekusi query. Beberapa metode yang ada di dalamnya antara lain:
- __construct(): Constructor kelas yang menginisialisasi variabel-variabel untuk koneksi database.
- open(): Metode untuk membuka koneksi ke database.
- execute(): Metode untuk mengeksekusi query ke database.
- getResult(): Metode untuk mendapatkan hasil eksekusi query.
- executeAffected(): Metode untuk mengeksekusi query yang memengaruhi baris-baris di database (seperti INSERT, UPDATE, DELETE).
- close(): Metode untuk menutup koneksi ke database.
- getFoodArray(): Metode untuk mendapatkan data makanan dari database dalam bentuk array asosiatif.
- getRestoArray(): Metode untuk mendapatkan data restoran dari database dalam bentuk array asosiatif.

**3. classes/Template.php**

File ini berisi kelas Template yang digunakan untuk mengelola template. Beberapa metode yang ada di dalamnya antara lain:
- __construct(): Constructor kelas yang menginisialisasi nama file template.
- clear(): Metode untuk membersihkan template dari placeholder yang cocok dengan pola DATA_[A-Z|_|0-9]+.
- write(): Metode untuk menampilkan isi template yang telah dibersihkan.
- getContent(): Metode untuk mendapatkan isi template yang telah dibersihkan.
- replace(): Metode untuk mengganti placeholder dalam template dengan nilai yang diberikan. Placeholder diganti menggunakan ekspresi reguler.

**4. classes/Chef.php**

Kelas ini bertanggung jawab untuk mengelola data chef. Ini termasuk operasi-operasi seperti mengambil semua data chef, mencari chef berdasarkan ID, menambahkan, memperbarui, dan menghapus data chef. Kelas ini juga memiliki metode untuk mengambil data chef yang telah digabungkan dengan informasi makanan dan restoran terkait, mencari chef berdasarkan kata kunci, serta mengambil data chef untuk pengurutan data.

**5. classes/Food.php**

Kelas ini bertanggung jawab untuk mengelola data makanan. Ini termasuk operasi-operasi seperti mengambil semua data makanan, mencari makanan berdasarkan ID, menambahkan, memperbarui, dan menghapus data makanan.

**6. classes/Resto.php**

Kelas ini bertanggung jawab untuk mengelola data restoran. Ini termasuk operasi-operasi seperti mengambil semua data restoran, mencari restoran berdasarkan ID, menambahkan, memperbarui, dan menghapus data restoran.

**7. index.php**

Ini adalah halaman utama yang menampilkan daftar chef. Proses pengambilan data chef dilakukan dengan menggunakan instance dari kelas Chef. Jika pengguna melakukan pencarian, fungsi searchChef() dipanggil untuk mencari data chef berdasarkan kriteria tertentu. Jika pengguna melakukan pengurutan, fungsi getChefJoinSorted() dipanggil untuk mengambil data chef yang sudah diurutkan. Data chef yang diambil kemudian digabungkan dengan tag HTML untuk ditampilkan.

**8. detail.php**

Halaman ini menampilkan detail dari seorang chef berdasarkan ID yang dipilih. Proses pengambilan data chef berdasarkan ID dilakukan dengan menggunakan instance dari kelas Chef dan fungsi getChefById(). Jika pengguna memilih untuk menghapus data, fungsi deleteData() akan dipanggil. Selanjutnya, data chef yang diperoleh digabungkan dengan tag HTML untuk ditampilkan.

**9. food.php**

Ini adalah halaman untuk mengelola data makanan. Proses pengambilan data makanan dilakukan dengan menggunakan instance dari kelas Food. Data makanan yang diambil kemudian digabungkan dengan tag HTML untuk ditampilkan dalam bentuk tabel. Jika pengguna memilih untuk menghapus data makanan, fungsi deleteFood() akan dipanggil.

**10. resto.php**

Halaman ini mirip dengan food.php, tetapi untuk mengelola data restoran. Proses pengambilan data restoran dilakukan dengan menggunakan instance dari kelas Resto. Data restoran yang diambil kemudian digabungkan dengan tag HTML untuk ditampilkan dalam bentuk tabel. Jika pengguna memilih untuk menghapus data restoran, fungsi deleteResto() akan dipanggil.

File food dan resto menggunakan template yang sama (skintabel.html) untuk menampilkan halaman web dan melakukan beberapa penyesuaian terhadap data yang ditampilkan pada template tersebut.

**11. tambahChef.php**

File ini bertanggung jawab untuk menambahkan data chef ke dalam database. Program ini melakukan hal berikut:
- Mengambil data makanan dan restoran dari database.
- Menyiapkan form HTML dengan dropdown untuk memilih makanan dan restoran.
- Jika pengguna mengirimkan data melalui metode POST, file ini akan memproses data tersebut dan menambahkannya ke dalam database dengan addData.
- Jika penambahan data berhasil, pengguna akan dialihkan ke halaman utama (index.php). Jika gagal, pengguna akan tetap berada di halaman ini.

**12. tambahFood.php**

File ini bertanggung jawab untuk menambahkan data makanan ke dalam database. Program ini melakukan hal serupa dengan tambahChef.php, namun untuk entitas makanan.

**13. tambahResto.php**

File ini bertanggung jawab untuk menambahkan data restoran ke dalam database. Program ini juga melakukan hal serupa dengan tambahChef.php, namun untuk entitas restoran.

**14.updateChef.php**

File ini bertanggung jawab untuk memperbarui data seorang chef yang telah ada dalam database. Program ini melakukan hal berikut:
- Mengambil data chef yang akan diperbarui dari database berdasarkan ID yang diberikan.
- Mengambil data makanan dan restoran dari database.
- Menyiapkan form HTML dengan dropdown untuk memilih makanan dan restoran. Form ini akan diisi dengan data chef yang akan diperbarui.
- Jika pengguna mengirimkan data melalui metode POST, file ini akan memproses data tersebut dan memperbarui data chef dalam database dengan UpdateData.
- Jika pembaruan data berhasil, pengguna akan dialihkan ke halaman utama (index.php). Jika gagal, pengguna akan tetap berada di halaman ini.

**15. updateFood.php**

File ini bertanggung jawab untuk memperbarui data makanan yang telah ada dalam database. Program ini melakukan hal serupa dengan updateChef.php, namun untuk entitas makanan.

**16. updateResto.php**

File ini bertanggung jawab untuk memperbarui data restoran yang telah ada dalam database. Program ini juga melakukan hal serupa dengan updateChef.php, namun untuk entitas restoran.

Setiap file tambah dan update menggunakan template yang sama (skinform.html) untuk menampilkan halaman web dan melakukan beberapa penyesuaian terhadap data yang ditampilkan pada template tersebut.

**17. templates/skin.html**

Ini adalah halaman utama aplikasi web. Terdapat navigasi di bagian atas halaman (navbar) yang memungkinkan pengguna untuk menavigasi ke berbagai bagian aplikasi. Terdapat area di bawah navigasi yang menampilkan daftar chef.

**18. templates/skindetail.html**

Halaman ini menampilkan detail seorang chef. Terdapat navbar di bagian atas halaman yang dikhususkan untuk button tambah chef. Menampilkan informasi detail tentang seorang chef, termasuk foto dan data lainnya.

**19. templates/skintabel.html**

Halaman ini menampilkan daftar data dalam bentuk tabel dengan opsi untuk menghapus atau mengedit setiap entri. di atas tabel terdapat button untuk tambah data.

**20. templates/skinform.html**

Halaman ini digunakan untuk menambah atau mengedit data. Terdapat formulir di halaman ini yang memungkinkan pengguna untuk memasukkan informasi data. Terdapat button "submit" yang akan mengirimkan data formulir ke database.

## Penjelasan Alur
1. Pengguna akan memulai dengan membuka halaman utama aplikasi.
2. File skin.html akan menampilkan navigasi (navbar) di bagian atas halaman, memungkinkan pengguna untuk menavigasi ke halaman utama, tambah chef baru, daftar makanan, daftar restoran, metode pencarian dan metode pengurutan untuk kata kunci nama chef, asal chef, atau nama resto.
3. Di bawah navbar terdapat data chef yang ditampilkan
4. Jika pengguna klik navbar tambah chef, maka akan menampilkan halaman form di mana pengguna dapat memasukkan data chef baru yang nantinya akan masuk ke dalam database dan akan ditampilkan jika sudah submit. Begitu pula dengan form tambah makanan dan juga restoran, serta form update untuk ketiganya. 
5. Jika pengguna klik navbar daftar makanan atau daftar restoran, maka akan menampilkan daftar data makanan yang ditampilkan dalam bentuk tabel, dengan opsi untuk menghapus atau mengedit setiap entri serta di atas terdapat button untuk menambahkan data makanan atau restoran.
6. Ketika pengguna memilih salah satu data seorang chef dari daftar, mereka akan diarahkan ke halaman detail untuk melihat detail chef tersebut. Kemudian di dalamnya pun terdapat opsi untuk mengedit atau menghapus data chef dari halaman ini.
7. Ketika pengguna ingin menghapus data makanan atau restoran, namun data tersebut berada di data chef, maka data yang ingin dihapus tersebut akan menampilkan gagal hapus

## Dokumentasi saat Program Dijalankan
1. index (data chef)
![index](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/062655a2-d1d7-4654-b59f-6a82d24349af)

2. detail chef
![detail](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/61c2cbc7-2ce6-4b54-b992-813720a64a3b)

3. tambah chef
![tambah data](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/558c8527-b203-4ffc-a8de-0aea7747f20d)

4. tambah (dorpdown makanan)
![tambah dropdown dari foreignkey 1](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/8694f428-6f7b-4013-b613-d3845a1e8f88)

5. tambah (dropdown restoran)
![tambah dropdown dari foreignkey 2](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/2a0427b1-efd9-4e91-befb-e187791dabfd)

6. edit chef
![edit data](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/01450039-ffbd-4052-a2e1-9b4e8a1a51b1)

7. edit (dorpdown makanan)
![edit dropdown dari foreignkey 1](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/fff614ff-3ea0-462a-8570-e77e095035af)

8. edit (dorpdown restoran)
![edit dropdown dari foreignkey 2](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/45057a0b-e947-40ea-aa6f-0a6fd24a2a6d)

9. hapus data
![hapus data](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/3edefafb-d72c-403d-9a82-124a63ad3c4f)

10. tabel daftar makanan
![tabel makanan](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/633dc0fa-bb40-4863-bdc3-08e27c05b787)

11. tabel daftar restoran
![tabel restoran](https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/ef8bb659-4e37-4e8e-8ae7-1bc202ab3315)

add update delete makanan dan restoran sama dengan chef hanya berbeda atribut

12. Video preview
https://github.com/jasminefwz/TP3DPBO2024C2/assets/147362810/c82a18fa-edb9-4dba-a8e0-595cd5bc0428
