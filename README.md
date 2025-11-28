# 🏫 Student Management System (CRUD)

# 📋 Requirements

To run this project, you need:

- PHP 8.3.26 (Included in Laragon).

- MySQL 8.4.3 Database (Included in Laragon).

- Laragon local server environment. Donwload at: https://laragon.org/download

- HeidiSQL for database management (Included in Laragon).

- Also it uses Bootstrap for better UI.

# 🚀 Run Project

First we have to install Laragon on our PC.

1. Start Laragon services (this includes PHP and MySQL (in this case, HeidySQL)
<img width="958" height="655" alt="Captura de pantalla 2025-11-27 215824" src="https://github.com/user-attachments/assets/7b3f9def-f71b-4b73-9db0-b7475fa22baa" />

2. The go the GitHub page where the project is located: https://github.com/Paula5123/deber1

3. Download the project as .zip or clone it. You have to place the new project in the following route.
<img width="328" height="53" alt="Captura de pantalla 2025-11-27 220229" src="https://github.com/user-attachments/assets/9279210b-671b-4549-bab5-ee7d31240c96" />

4. Open your terminal in Laragon and go into the project directory. In my case it is schoolSystem but you should have something like deber1-main)
<img width="420" height="59" alt="Captura de pantalla 2025-11-27 220506" src="https://github.com/user-attachments/assets/b43a7df3-c384-4998-a7e3-8c5eb4f1d831" />

5. Write the following command to create de DB, it includes some dummy data to enter (if the folder name is deber1-main, just change the schoolSystem to deber1-main): mysql -u root < C:\laragon\www\schoolSystem\sql\schema.sql
<img width="615" height="53" alt="Captura de pantalla 2025-11-27 220629" src="https://github.com/user-attachments/assets/b2f4ce70-502e-45eb-bed7-0aebc4c2de95" />
The script is also in the sql folder in this project GitHub.
<img width="381" height="68" alt="Captura de pantalla 2025-11-27 221145" src="https://github.com/user-attachments/assets/ec540d4a-f21f-4b34-bcff-8c5d7c267aa0" />

7. Open your browser, I left everything by default on Laragon so my URL looks like this: http://localhost/schoolSystem/public/
Since the name changes it might look like: http://localhost/deber1-main/public/

8. Test the web app. The dummy data to enter is
Username: teacher1
Password: 12345
