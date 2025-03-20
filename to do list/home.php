<?php
session_start();
include "proses/koneksi.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard </title>
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    padding: 12px 20px;
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.2);
}

.features {
    margin-left: 150px;
    gap: 50px;
    display: flex;
}


.features .dropbtn {
    text-decoration: none;
    color: black;
    opacity: 80%;
}

.dropdown {
    position: relative;
    display: inline-block;
    margin-top: 10px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 150px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 3px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color:#c7c6c6;
    color: black !important;
   }

.dropdown:hover .dropdown-content {
    display: block;
}

.addtask {
    border-radius: 100px;
    border: none;
    background-color: #0074cc;
    color: white;
    padding: 10px 13px;
    font-size: 14px;
    box-shadow: 0 1px 5px  #252525;
}

.addtask:hover {
    background-color: #d7d7d7;
    color: black;
    opacity: 80%;
    transition: 0.1s;
}

.profile-pic {
    position:relative;
    cursor: pointer;
}

.profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid rgb(131, 131, 131);
    aspect-ratio: 1 / 1;
    gap: 10px;
}

.logout-btn {
    padding: 5px 10px;
    margin-left: 5px;
    border: 2px solid #f90000;
    border-radius: 9px;
    background-color: #fff;
    font-weight: bolder;
    color: #f90000;
    font-size: 14px;
}

.logout-btn:hover {
    background-color: #f90000;
    color: white;
    transition: 0.1s;
}
.tablecontainer {
    text-align: center;
    
}

/* tabel */
table {
    width: 100%;
    border-collapse: collapse;
    border-top: 3px solid #dddddd;
}

th {
    text-align: left;
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    padding: 12px;
    background-color: #f4f4f4;
    font-weight: bold;
}


td {
    padding: 3px 5px;
    border-bottom: 1px solid #ddd;
    border-right: 1px solid #ddd;
    text-align: left;
}

td:nth-child(1) {
    max-width: 50px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

th:nth-child(1) {
    resize: horizontal;
    overflow: auto;
    max-width: 500px;
    min-width: 50px;
}

.delete-btn {
    background-color: red;
    border: none;
    color: white;
    padding: 7px 10px;
    border-radius: 4px;
    cursor: pointer;
}

.delete-btn:hover {
    background-color: #c82333;
}

.edit-btn {
    background-color: rgb(228, 199, 49); 
    border: none;
    color: white;
    padding: 7px 10px;
    margin: 5px;
    border-radius: 4px;
    cursor: pointer;
}

.edit-btn:hover {
    background-color: rgb(172, 145, 9);
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    max-width: 90%;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

.modal-content {
    background-color: #fff;
    padding: 50px;
    border-radius: 8px;
    width: 300px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
    
.modal-content label {
    margin-bottom: 2px;
}

form {
    display: flex;
    flex-direction: column;
}

input, select {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button[type="submit"] {
    padding: 7px 10px;
    background-color: #0074cc;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 2px;
}

button[id="cancelTaskBtn"] {
    padding: 7px 10px;
    margin-top: 5px;
    background-color: #0074cc;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #03599a;
}

button[id="cancelBtn"]:hover {
    background-color: #03599a;
}

#notificationContainer {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 300px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    z-index: 1000;
}

.notification {
    background-color: #333;
    color: white;
    padding: 10px 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    opacity: 1;
    transition: opacity 0.5s ease-in-out;
}

.fade-out {
    opacity: 0;
}

.logoutModal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    height: auto;
    max-width: 90%;
    text-align:center;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    
}

.logoutModal h2 {
    margin: 20px 0 20px 0;
}


.logoutExit {
    padding: 12px 120px;
    margin-bottom: 7px;
    border-radius: 20px;
    border: none;
    color: white;
    background-color: #0074cc;
}

.logoutExit:hover {
    background-color: #03599a;
}

.logoutCancel {
    padding: 12px 110px;
    border: 1px solid #c7c6c6;
    border-radius: 20px;
    background-color: #fff;
    margin-bottom: 20px;
}

.logoutCancel:hover {
    background-color:rgb(246, 246, 246);
}

    </style>
</head>

<body>
<!-- header -->
    <div class="header">
        <div class="features">
            <button class="addtask" id="createTaskBtn">Create Task</button>
            <div class="dropdown">
                <a class="dropbtn" href="#"> Category </a>
                <div class="dropdown-content" id="categoryFilter">
                    <a href="#" class="filter-category" data-category="all"> All </a>
                    <a href="#" class="filter-category" data-category="school"> School </a>
                    <a href="#" class="filter-category" data-category="work"> Work </a>
                    <a href="#" class="filter-category" data-category="personal"> Personal </a>
                    </div>
            </div>
        </div>
        <div class="userlogout" id="userLogout"> 
            <button class="logout-btn" id="logoutBtn">Logout</button>
            <div class="logoutModal">
                <h2 class="logoutTitle"> Are you sure you <br> want to exit?</h2>
                <div class="logoutModalBtn">
                    <button class="logoutExit" id="logoutExit"> Exit </button>
                </div>
                <div class="logoutModalBtn">
                    <button class="logoutCancel" id="logoutCancel"> Cancel </button>
            </div>
            </div>
        </div>
        </div>

    
    
    <div class="tablecontainer">
        <table id="taskTable">
            <thead>
                <tr>
                    <th>Tasks</th>
                    <th>Category</th>
                    <th>Due date (Day)</th>
                    <th>Due date (Time)</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="taskTableBody">
                
            </tbody>
        </table>
    </div>

    <div id="modal" class="modal">
    <div class="modal-content">
        <h2 id="modalTitle">Create New Task</h2>
        <form id="taskForm" action="proses/add_tugas.php" method="POST">
            <label for="task_name">Task Name</label>
            <input type="text" id="task_name" name="task_name" autocomplete="off" required>

            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="school">School</option>
                <option value="work">Work</option>
                <option value="personal">Personal</option>
            </select>

            <label for="due_date_day">Due Date (Day)</label>
            <input type="date" id="due_date_day" name="due_date_day" required>

            <label for="due_date_time">Due Date (Time)</label>
            <input type="time" id="due_date_time" name="due_date_time" required>

            <input type="hidden" id="task_id" name="task_id">
        <div class="modal-button">
            <button type="button" id="cancelTaskBtn">Cancel</button>
            <button type="submit" id="saveTaskBtn">Add Task</button>
        </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modal");
    const createTaskBtn = document.getElementById("createTaskBtn");
    const taskForm = document.getElementById("taskForm");
    const modalTitle = document.getElementById("modalTitle");
    const saveTaskBtn = document.getElementById("saveTaskBtn");
    const cancelTaskBtn = document.getElementById("cancelTaskBtn");
    const taskTableBody = document.getElementById("taskTableBody");
    const categoryFilter = document.getElementById("categoryFilter");
    const categoryLinks = document.querySelectorAll(".filter-category");
    const userLogout = document.getElementById("userLogout");
    const logoutBtn = document.getElementById("logoutBtn");
    const logoutCancel = document.getElementById("logoutCancel");
    const logoutExit = document.getElementById("logoutExit");
    const logoutModal = document.querySelector(".logoutModal");

    let today = new Date().toISOString().split("T")[0];
    document.getElementById("due_date_day").min = today;

    

    createTaskBtn.addEventListener("click", function () {
        modal.style.display = "flex";
        taskForm.reset();
        taskForm.setAttribute("data-mode", "add");
        document.getElementById("task_id").value = "";
    });

    cancelTaskBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

logoutBtn.addEventListener("click", () => {
    logoutModal.style.display = "block";
});

logoutCancel.addEventListener("click", () => {
    logoutModal.style.display = "none";
});

window.addEventListener("click", (e) => {
    if (e.target === logoutModal) {
        logoutModal.style.display = "none";
    }
});

document.getElementById("logoutExit").addEventListener("click", function () {
    window.location.href = "proses/logout.php";
});

taskForm.addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(taskForm);
    let mode = taskForm.getAttribute("data-mode");
    let url = mode === "edit" ? "proses/update_task.php" : "proses/add_tugas.php";

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response dari server:", data);

        if (data.success) {
            console.log("ID yang diterima:", data.id); 
            console.log("Mode:", mode); 

            if (mode === "edit") {
                let rowButton = document.querySelector(`.edit-btn[data-id="${data.id}"]`);
                console.log("Tombol edit ditemukan:", rowButton);

                if (rowButton) {
                    let row = rowButton.closest("tr");
                    console.log("Baris ditemukan:", row);

                    if (row) {
                        row.cells[0].textContent = data.task_name;
                        row.cells[1].textContent = data.category;
                        row.cells[2].textContent = data.due_date_day;
                        row.cells[3].textContent = data.due_date_time;
                    } else {
                        console.error("Error: Baris tabel tidak ditemukan!");
                    }
                } else {
                    console.error(`Error: Tidak menemukan tombol edit dengan data-id=${data.id}`);
                }
            } else {
                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${data.task_name || "No Name"}</td>
                    <td>${data.category || "No Category"}</td>
                    <td>${data.due_date_day || "No Date"}</td>
                    <td>${data.due_date_time || "No Time"}</td>
                    <td>
                        <button class="edit-btn" data-id="${data.id}">Edit</button>
                        <button class="delete-btn" data-id="${data.id}">Delete</button>
                    </td>
                `;
                taskTableBody.appendChild(newRow);
            }

            modal.style.display = "none";
            taskForm.reset();
        } else {
            alert("Gagal menyimpan tugas.");
        }
    })
    .catch(error => console.error("Error:", error));
});


fetch("proses/getall_tugas.php")
    .then(response => response.json())
    .then(data => {
        taskTableBody.innerHTML = "";

        if (data.error) {
            console.error(data.error);
            return;
        }

        data.forEach(task => {
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${task.task_name}</td>
                <td>${task.category}</td>
                <td>${task.due_date_day}</td>
                <td>${task.due_date_time}</td>
                <td>
                    <button class="edit-btn" data-id="${task.id}">Edit</button>
                    <button class="delete-btn" data-id="${task.id}">Delete</button>
                </td>
            `;
            taskTableBody.appendChild(newRow);
        });
    })
    .catch(error => console.error("Error:", error));

    taskTableBody.addEventListener("click", function(event) {
        if (event.target.classList.contains("edit-btn")) {
            let row = event.target.closest("tr");
            let taskId = event.target.getAttribute("data-id");
            let taskName = row.cells[0].textContent;
            let category = row.cells[1].textContent.toLowerCase();
            let dueDateDay = row.cells[2].textContent;
            let dueDateTime = row.cells[3].textContent;

            document.getElementById("task_name").value = taskName;
            document.getElementById("category").value = category;
            document.getElementById("due_date_day").value = dueDateDay;
            document.getElementById("due_date_time").value = dueDateTime;
            document.getElementById("task_id").value = taskId;

            document.getElementById("saveTaskBtn").textContent = "Update Task";
            document.getElementById("taskForm").setAttribute("data-mode", "edit");
            modal.style.display = "flex";
        }

        if (event.target.classList.contains("delete-btn")) {
            let taskId = event.target.getAttribute("data-id");

            if (confirm("Yakin ingin menghapus tugas ini?")) {
                fetch("proses/delete_task.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded" 
                    },
                    body: `id=${taskId}`
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        event.target.closest("tr").remove();
                    } else {
                        alert("Gagal menghapus tugas: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        }
    });
});

if (Notification.permission !== "granted") {
    Notification.requestPermission().then(permission => {
        if (permission !== "granted") {
            console.log("Izin notifikasi ditolak.");
        }
    });
}

let notifiedTasks = new Set(JSON.parse(localStorage.getItem("notifiedTasks") || "[]"));

function saveNotifiedTasks() {
    localStorage.setItem("notifiedTasks", JSON.stringify([...notifiedTasks]));
}

function checkDueDates() {
    let tasks = document.querySelectorAll("#taskTable tbody tr");
    let now = new Date();
    console.log("Checking tasks at:", now.toLocaleTimeString());
    tasks.forEach(row => {
        let task_name = row.cells[0].textContent.trim();
        let due_date_day = row.cells[2].textContent.trim();
        let due_date_time = row.cells[3].textContent.trim();
        
        let dueDate = new Date(`${due_date_day}T${due_date_time}`);
        if (isNaN(dueDate.getTime())) {
            console.error(`Format tanggal salah: ${due_date_day}T${due_date_time}`);
            return;
        }

        let timeDiff = dueDate - now;
        
        if (timeDiff > 0) {
            if (timeDiff > 60 * 60 * 1000 && timeDiff <= 24 * 60 * 60 * 1000 && !notifiedTasks.has(`${task_name}-1d`)) {
                showNotification(task_name, "1 hari lagi!");
                notifiedTasks.add(`${task_name}-1d`);
            }
            else if (timeDiff > 10 * 60 * 1000 && timeDiff <= 60 * 60 * 1000 && !notifiedTasks.has(`${task_name}-1h`)) {
                showNotification(task_name, "1 jam lagi!");
                notifiedTasks.add(`${task_name}-1h`);
            }
            else if (timeDiff > 0 && timeDiff <= 10 * 60 * 1000 && !notifiedTasks.has(`${task_name}-10m`)) {
                showNotification(task_name, "10 menit lagi!");
                notifiedTasks.add(`${task_name}-10m`);
            }
        }

        if (timeDiff <= 0 && timeDiff > -60000 && !notifiedTasks.has(`${task_name}-deadline`)) {
            showNotification(task_name, "Waktunya menyelesaikan tugas!");
            notifiedTasks.add(`${task_name}-deadline`);
        }
    });

    saveNotifiedTasks();
}

function showNotification(task_name, waktu) {
    let options = {
        body: `Tugas \"${task_name}\" jatuh tempo! ${waktu}`,
        icon: "assets/img/bell.svg"
    };
    new Notification("To-Do List Reminder", options);
}

setInterval(() => {
    let now = new Date();
    if (now.getSeconds() === 0) {
        checkDueDates();
    }
}, 1000);


    function loadTasks(selectedCategory = "all") {
        fetch("proses/getall_tugas.php")
            .then(response => response.json())
            .then(data => {
                taskTableBody.innerHTML = "";

                if (data.error) {
                    console.error(data.error);
                    return;
                }

                data.forEach(task => {
                    if (selectedCategory === "all" || task.category.toLowerCase() === selectedCategory) {
                        let newRow = document.createElement("tr");
                        newRow.innerHTML = `
                            <td>${task.task_name}</td>
                            <td>${task.category}</td>
                            <td>${task.due_date_day}</td>
                            <td>${task.due_date_time}</td>
                            <td>
                                <button class="edit-btn" data-id="${task.id}">Edit</button>
                                <button class="delete-btn" data-id="${task.id}">Delete</button>
                            </td>
                        `;
                        taskTableBody.appendChild(newRow);
                    }
                });
            })
            .catch(error => console.error("Error:", error));
    }

    categoryFilter.addEventListener("click", function (event) {
        event.preventDefault();
        let selectedCategory = event.target.getAttribute("data-category");

        if (selectedCategory) {
            loadTasks(selectedCategory);
        }
    });


    function filterTasks(category) {
            let rows = document.querySelectorAll("#taskTable tbody tr");
            rows.forEach(row => {
                let taskCategory = row.cells[1].textContent.toLowerCase();
                if (category === "all" || taskCategory === category) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

    let categoryLinks = document.querySelectorAll(".dropdown-content a");

        categoryLinks.forEach(link => {
        link.addEventListener("click", function (event) {
        event.preventDefault();
        let category = this.getAttribute("data-category");
        filterTasks(category);
    });
});


        fetch("proses/getall_tugas.php")
            .then(response => response.json())
            .then(data => {
                taskTableBody.innerHTML = "";
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                data.forEach(task => {
                    let newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${task.task_name}</td>
                        <td>${task.category}</td>
                        <td>${task.due_date_day}</td>
                        <td>${task.due_date_time}</td>
                        <td>
                            <button class="edit-btn" data-id="${task.id}">Edit</button>
                            <button class="delete-btn" data-id="${task.id}">Delete</button>
                        </td>
                    `;
                    taskTableBody.appendChild(newRow);
                });
            })
            .catch(error => console.error("Error:", error));
</script>
</body>
</html>