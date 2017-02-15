<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="fa fa-upload" aria-hidden="true"></span>
        Upload logo
    </div>
    <div class="panel-body">
        <p>
        <form id="form1" method="post" enctype="multipart/form-data">
            <input type="hidden" name="add" value="1"/>

            <fieldset>
                <legend>Favicon</legend>

                <input type="file" name="favicon"/>
            </fieldset>
            <br/>
            <button type="submit" class="btn btn-primary">
                <span class="fa fa-upload"> </span> Upload
            </button>

            <a href="javascript:history.back(1)" class="btn btn-danger">
                <span class="fa fa-forword"></span> Back</a>
        </form>
        </p>
    </div>
</div>