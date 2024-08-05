document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    // ตรวจสอบชื่อผู้ใช้และรหัสผ่าน
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
  
    if (username === "admin" && password === "password") { // เปลี่ยนเป็นข้อมูลจริง
      window.location.href = "dashboard.html";
    } else {
      alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
    }
  });
  