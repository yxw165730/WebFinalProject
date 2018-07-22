<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Pizza Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Admin/css/style.css">
        <style>
            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */

            .row.content {
                height: 650px
            }
            /* Set gray background color and 100% height */

            .sidenav {
                background-color: #f1f1f1;
                height: 100%;
            }
            /* On small screens, set height to 'auto' for the grid */

            @media screen and (max-width: 767px) {
                .row.content {
                    height: auto;
                }
            }

        </style>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">Pizza Shop Management System</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Management</a></li>
                        <li><a href="../index.php">Main Page</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid contentcontainer">
            <div class="row content">

                <div class="col-sm-12">
                    <form name="frmUser" method="post" action="">
                        <div class="row right-content">
                            <h2 class="margin-top-0">Pizza management</h2>
                            <p style="margin-top:40px">You Can Add and Deletee Product Here</p>
                            <div>

                            </div>

                        </div>
                        <hr>
                    </form>


                    <div id="modal-content-edit">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Add a Product</h4>
                        </div>
                        <div class="modal-body">
                            <form action="handleupload.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="bookName-modal">Upload Image:</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="category">Category:</label>
                                    <div class="col-sm-2">
                                        <select name="category" id="category">
                                            <option value="Pizza">Pizza</option>
                                            <option value="Hot Dog">Hot Dog</option>
                                            <option value="Ice Cream">Ice Cream</option>
                                        </select>
                                    </div>
                                    <label class="control-label col-sm-2" for="product_name">Product Name:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="product_name" value="">
                                    </div>
                                    <label class="control-label col-sm-2" for="price">Price:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="price" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="description">Description:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="description" value="">
                                    </div>
                                    <label class="control-label col-sm-2" for="stock">Stock:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="stock" value="">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-blue" id='upload_submit'>Submit</button>
                                </div>
                            </form>
                        </div>


                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" id="progress" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                <p id="myprogressp"></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </body>

</html>
