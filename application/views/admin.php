<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('elements/header');?>
<body>

<div class="container" id="wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="correctionsData" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ArticleURL</th>
                            <th>Original Text</th>
                            <th>Users Text</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($corrections as $correction):?>
                            <tr>
                                <td><?php echo $correction->id?></td>
                                <td><?php echo $correction->articleURL?></td>
                                <td><?php echo $correction->originalText?></td>
                                <td><?php echo $correction->usersText?></td>
                                <td>
                                    <button type="button" class="btn btn-success" value="<?php echo $correction->id?>">Approve</button>&nbsp;&nbsp;
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" value="<?php echo $correction->id?>">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php $this->load->view('elements/footer');?>
<script>
    $(document).ready(function () {
        var table = $('#correctionsData').DataTable();

        $('button.btn-success').click(function () {
            var obj = $(this);
            $.ajax({
                url : '/fb/setApproved',
                data : {
                    id : $(this).val()
                },
                method: 'post',
                dataType: 'json',
                success : function (res) {
                    if(res.error == false) {
                        table
                            .row(obj.parents('tr'))
                            .remove()
                            .draw();
                    }
                }
            });
        });

        $('button.btn-danger').click(function () {
            var obj = $(this);
            bootbox.confirm("Are you sure?", function (result) {
                if(result) {
                    $.ajax({
                        url: '/fb/delete',
                        data: {
                            id: obj.val()
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function (res) {
                            if (res.error == false) {
                                table
                                    .row(obj.parents('tr'))
                                    .remove()
                                    .draw();
                            }
                        }
                    });
                }
            });
        });
    });
</script>
</body>
</html>