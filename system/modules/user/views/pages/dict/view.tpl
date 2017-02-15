<div class="content">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            {if isset($data.word)} {$data.word} {/if}
            ({if isset($data.spelling)} {$data.spelling} {/if})
        </div>
        <div class="panel-body">

            <p>Word: {if isset($data.word)} {$data.word} {/if} <br/>

            <ul class="nav nav-tabs">                 
                <li role="presentation" class="active"> <a href="#home" aria-controls="home" role="tab" data-toggle="tab"> Spelling & Meaning </a></li>
                <li role="presentation"><a href="#r_word" aria-controls="r_word" role="tab" data-toggle="tab"> Related Words </a></li>
                <li role="presentation"><a href="#examlpes" aria-controls="examlpes" role="tab" data-toggle="tab"> Examples </a></li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content"  role="tablist">
                <div role="tabpanel" class="tab-pane fade in active" id="home">
                    <p align="justify"> Spelling: {if isset($data.spelling)} {$data.spelling} {/if} <br/> <br/>
                        Meaning: <br/>
                        {if isset($data.meaning)} {$data.meaning} {/if}
                    </p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="r_word">
                    <p align="justify"> Related Word: <br/>
                        {if isset($data.r_word)} {$data.r_word} {/if}
                    </p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="examlpes">
                    <p align="justify">  Examples: <br/>
                        {if isset($data.examples)} {$data.examples} {/if}
                    </p>
                </div>
            </div>
            <br/>
            <a href="javascript:history.back(1)" class="btn btn-warning" style="text-decoration: none;"> <span class="fa fa-backward"></span> Go Back </a>
        </div>
    </div>
</div>