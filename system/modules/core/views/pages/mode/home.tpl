
<div class="img-responsive">
      <div class="img-responsive text-center">
          <img src="{$layoutParams.media_img}favicon.gif" alt="{$layoutParams.configs.app_name}
           LOGO" style="width: 150px; height: 100px;"/>
          <br/><br/>
      </div>

    <form action="{$layoutParams.root}search?q=" method="get" enctype="application/x-www-form-urlencoded">
        <div id="newtab-search-form">
            <div id="newtab-search-icon"></div>
            <input type="search" id="suggestons" name="q" value="" class="newtab-search-text" aria-label="Search query" maxlength="256"
                   dir="auto" autocomplete="on" aria-autocomplete="true" placeholder="Type any word to search......"/>
            <input type="submit" id="newtab-search-submit" value="" aria-label="Submit search"/>
        </div>
    </form>

</div>

<link rel="stylesheet" href="http://web.alan.local/system/themes/liteboot/css/jquery-ui.css">
<script src="http://web.alan.local/system/themes/liteboot/js/jquery.js"></script>
<script src="http://web.alan.local/system/themes/liteboot/js/jquery-ui.js"></script>

<div class="input-group">
    <span class="text-left">Hello</span>
    <span class="text-right">I want it.</span>
</div>