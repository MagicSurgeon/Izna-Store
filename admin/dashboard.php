<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --poppins: 'Poppins', sans-serif;
            --lato: 'Lato', sans-serif;

            --light: #F9F9F9;
            --blue: #3C91E6;
            --light-blue: #CFE8FF;
            --grey: #eee;
            --dark-grey: #AAAAAA;
            --dark: #342E37;
            --red: #DB504A;
            --yellow: #FFCE26;
            --light-yellow: #FFF2C6;
            --orange: #FD7238;
            --light-orange: #FFE0D3;
        }

        body {
            background: var(--grey);
            font-family: var(--poppins);
            overflow-x: hidden;
        }

        main {
            width: 100%;
            padding: 89px 0 0 0;
            max-height: calc(100vh - 56px);
            overflow-y: auto;
        }

        main .head-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            grid-gap: 16px;
            flex-wrap: wrap;
        }

        main .head-title .left h1 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }

        main .head-title .left .breadcrumb {
            display: flex;
            align-items: center;
            grid-gap: 16px;
        }

        main .head-title .left .breadcrumb li {
            color: var(--dark);
        }

        main .head-title .left .breadcrumb li a {
            color: var(--dark-grey);
            pointer-events: none;
        }

        main .head-title .left .breadcrumb li a.active {
            color: var(--blue);
            pointer-events: unset;
        }

        main .head-title .btn-download {
            height: 36px;
            padding: 0 16px;
            border-radius: 36px;
            background: var(--blue);
            color: var(--light);
            display: flex;
            justify-content: center;
            align-items: center;
            grid-gap: 10px;
            font-weight: 500;
        }

        main .box-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            grid-gap: 24px;
            margin-top: 36px;
        }

        main .box-info li {
            padding: 24px;
            background: var(--light);
            border-radius: 20px;
            display: flex;
            align-items: center;
            grid-gap: 24px;
        }

        main .box-info li .bx {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main .box-info li:nth-child(1) .bx {
            background: var(--light-blue);
            color: var(--blue);
        }

        main .box-info li:nth-child(2) .bx {
            background: var(--light-yellow);
            color: var(--yellow);
        }

        main .box-info li:nth-child(3) .bx {
            background: var(--light-orange);
            color: var(--orange);
        }

        main .box-info li .text h3 {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark);
        }

        main .box-info li .text p {
            color: var(--dark);    
        }

        main .table-data {
            display: flex;
            flex-wrap: wrap;
            grid-gap: 24px;
            margin-top: 24px;
            width: 100%;
            color: var(--dark);
        }

        main .table-data > div {
            border-radius: 20px;
            background: var(--light);
            padding: 24px;
            overflow-x: auto;
        }

        main .table-data .head {
            display: flex;
            align-items: center;
            grid-gap: 16px;
            margin-bottom: 24px;
        }

        main .table-data .head h3 {
            margin-right: auto;
            font-size: 24px;
            font-weight: 600;
        }

        main .table-data .head .bx {
            cursor: pointer;
        }

        main .table-data .order {
            flex-grow: 1;
            flex-basis: 500px;
        }

        main .table-data .order table {
            width: 100%;
            border-collapse: collapse;
        }

        main .table-data .order table th {
            padding-bottom: 12px;
            font-size: 13px;
            text-align: left;
            border-bottom: 1px solid var(--grey);
        }

        main .table-data .order table td {
            padding: 16px 0;
        }

        main .table-data .order table tr td:first-child {
            display: flex;
            align-items: center;
            grid-gap: 12px;
            padding-left: 6px;
        }

        main .table-data .order table td img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        main .table-data .order table tbody tr:hover {
            background: var(--grey);
        }

        main .table-data .order table tr td .status {
            font-size: 10px;
            padding: 6px 16px;
            color: var(--light);
            border-radius: 20px;
            font-weight: 700;
        }

        main .table-data .order table tr td .status.completed {
            background: var(--blue);
        }

        main .table-data .order table tr td .status.process {
            background: var(--yellow);
        }

        main .table-data .order table tr td .status.pending {
            background: var(--orange);
        }

        main .table-data .todo {
            flex-grow: 1;
            flex-basis: 300px;
        }

        main .table-data .todo .todo-list {
            width: 100%;
        }

        main .table-data .todo .todo-list li {
            width: 100%;
            margin-bottom: 16px;
            background: var(--grey);
            border-radius: 10px;
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        main .table-data .todo .todo-list li .bx {
            cursor: pointer;
        }

        main .table-data .todo .todo-list li.completed {
            border-left: 10px solid var(--blue);
        }

        main .table-data .todo .todo-list li.not-completed {
            border-left: 10px solid var(--orange);
        }

        main .table-data .todo .todo-list li:last-child {
            margin-bottom: 0;
        }

    </style>
</head>
<body>
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
            </div>
            <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Download PDF</span>
            </a>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3>1020</h3>
                    <p>New Order</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>2834</h3>
                    <p>Visitors</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>$2543</h3>
                    <p>Total Sales</p>
                </span>
            </li>
        </ul>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Recent Orders</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1021</td>
                            <td>
                                <img src="img/customer1.jpg" alt="">
                                <p>John Doe</p>
                            </td>
                            <td><span class="status completed">Completed</span></td>
                            <td>12 Aug 2024</td>
                        </tr>
                        <tr>
                            <td>#1022</td>
                            <td>
                                <img src="img/customer2.jpg" alt="">
                                <p>Jane Smith</p>
                            </td>
                            <td><span class="status process">Processing</span></td>
                            <td>15 Aug 2024</td>
                        </tr>
                        <tr>
                            <td>#1023</td>
                            <td>
                                <img src="img/customer3.jpg" alt="">
                                <p>Robert Brown</p>
                            </td>
                            <td><span class="status pending">Pending</span></td>
                            <td>17 Aug 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="todo">
                <div class="todo-list">
                    <li class="not-completed">
                        <span class="text">Complete the annual report</span>
                        <i class='bx bxs-check-circle'></i>
                    </li>
                    <li class="completed">
                        <span class="text">Update website content</span>
                        <i class='bx bxs-check-circle'></i>
                    </li>
                    <li class="not-completed">
                        <span class="text">Plan the next marketing campaign</span>
                        <i class='bx bxs-check-circle'></i>
                    </li>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
