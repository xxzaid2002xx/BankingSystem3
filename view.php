<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>التفاصيل</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .asid {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            max-width: 500px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .title h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .asid span {
            color: #555;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }

        .asid input[type="text"] {
            padding: 5px;
            margin-bottom: 10px;
            width: 100%;
        }

        .asid button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .asid hr {
            margin: 10px 0;
        }

        .bt2 {
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .bt2:hover {
            background-color: #d32f2f;
        }



            .asid button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%; /* أضفت هذا السطر لجعل جميع الأزرار بنفس العرض */
            box-sizing: border-box; /* أضفت هذا السطر لضمان أن العرض الكامل للزر لا يتأثر بالحواف البيضاء الإضافية */
        }

        .bt2 {
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%; /* أضفت هذا السطر لجعل جميع الأزرار بنفس العرض */
            box-sizing: border-box; /* أضفت هذا السطر لضمان أن العرض الكامل للزر لا يتأثر بالحواف البيضاء الإضافية */
        }
       
    </style>
</head>
<body>
    
      
    <?php
    $dolar = $_GET['dolar'];
    $date = $_GET['date'];
    $numer = $_GET['numer'];
    $cut = $_GET['cut'];
    $months = $_GET['months'];
    $total = $_GET['total'];
    $name = $_GET['name']; 
    $oldPay = $_GET['pay'];
    $AN = $_GET['AN'];
  
  
  
    
    if (isset($_POST['soll'])) {
        $inputValue = $_POST['var2'];
        $dolar = $dolar - $inputValue;
    
        // حفظ عملية الدفع
        $pay = intval($inputValue);
        
        if (isset($oldPay)) {
            $oldPay = intval($oldPay);
            $pay += $oldPay;
        }
    
        include "db_connect.php";
    
        // إجراء استعلام التحديث
        $sql = "UPDATE loan2 SET dolar = '$dolar' WHERE NAME = '$name'";
        $sql2 = "UPDATE loan2 SET pay = '$pay' WHERE NAME = '$name'";
    
        // قم بتنفيذ الاستعلامات والتحقق من نجاحها
        if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
            echo "تم تحديث القيمة بنجاح";
            header('Location: home.php');
            exit();
        } else {
            echo "حدث خطأ في تحديث القيمة: " . mysqli_error($con);
        }
    
        // أغلق اتصال قاعدة البيانات
        mysqli_close($con);
    }
  
  
     
    
  
    
      
    ?>

    <div class="asid">
        <div class="title">
            <center><h1>معلومات الزبون</h1></center>
        </div>
        <span>الاسم : <?php echo $name; ?></span> 
        <hr>
        <span>رقم الهاتف : <?php echo $numer; ?></span>
        <hr>
       <span>المبلغ الكلي : <?php echo $total; ?></span>
        <hr>
       <span>الاستقطاع : <?php echo $cut; ?></span>
        <hr>
        <span>تاريخ الانشاء : <?php echo $date; ?></span>
        <hr>
       <span> عدد الاشهر : <?php echo $months; ?></span>
        <hr>
        <span>الرقم الحسابي : <?php echo $AN; ?></span>
        <hr>
        <span>المتبقي : <?php echo $dolar; ?></span>
        <hr>
        <form method="post">
            <div class="soll">
                <span>مبلغ الاستقطاع</span>
                <input type="text" name="var2">
                <button name="soll" class="bt1">حفظ</button><br><br>
            </div>
        </form>
        <a href="home.php"><button class="bt2" name="del">رجوع بدون حفظ</button></a>
    </div>
</body>
</html>