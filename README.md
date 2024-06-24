
## คู่มือการใช้งานโปรเจ็กต์ Travel

โปรเจ็กต์นี้เป็นเว็บโชว์สถานที่ท่องเที่ยวในประเทศไทยที่พัฒนาด้วย PHP 
โปรเจ็กต์นี้ทำขึ้นมาเพื่อทำการศึกษาภาษา PHP


## การติดตั้ง

1. **โคลนโปรเจ็กต์จาก Repository**:
    ``` bash
    git clone <URL ของ Repository>
    cd <ชื่อโฟลเดอร์ของโปรเจ็กต์>
    ```

2. **ติดตั้งแพ็กเกจที่จำเป็น**:
    ``` bash
	composer install
    ```
3. **สร้าง database**:
	- ทำการ import file "travel_v2.sql" ที่อยู่ใน folder database
5. **ตั้งค่า env**:
    - สร้างไฟล์ `.env` เพื่อเพิ่มข้อมูลการเชื่อมต่อฐานข้อมูล ดังนี้:
    ``` bash
    DB_HOST="your host"
	DB_USERNAME="your username"
	DB_PASSWORD="your password"
	DB_NAME=travel
	DB_PORT="your port"
    ```
## การรันโปรเจ็กต์

1. **เริ่มเซิร์ฟเวอร์ในโหมดพัฒนา**:
    ``` bash
	composer start
    ```
    แอปพลิเคชันจะรันที่ `http://localhost:8000`
## ฟังก์ชันการทำงาน
- สามารถดูสถานที่ท่องเที่ยวทั้งหมดได้
- สามารถกดเข้าไปดูรายละเอียดของสถานที่ท่องเที่ยวได้
- สามารถก็เลือกดูสถานที่ท่องเที่ยวเฉพาะจังหวัดได้
- มีหน้า Login สำหรับ admin
- admin แก้ไข content ได้
- admin ลบ content ได้
- admin เพิ่ม content ได้
- admin ซ่อน content ได้
- admin เลิกซ่อน content ได้
- admin สามารถเพิ่มรูปภาพได้
