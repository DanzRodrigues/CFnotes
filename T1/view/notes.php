<div id="body-layout">
    <div id="nav-search" class="hidden-nav">
        <form>
            <input type="text" id="search-input" placeholder="Search...">
        </form>
        <div id="search-result">
            <p>Your search results will be displayed here.</p>
        </div>                 
    </div>
    <div id="nav-folder" class="hidden-nav">
        <div id="folder" class="folder">
            Your notes are going to be displayed here.
        </div>
    </div>
    <div id="nav-calendar" class="hidden-nav">
        <div id="calendar" class="calendar">
            Here your calendar and schedules will be displayed.
        </div>
    </div>
    <div id="nav-share" class="hidden-nav">
        <div id="share" class="share">
            Here you may share your notes.
        </div>
    </div>
    <nav class="icon-bar">
        <a id="btn_new" class="active"><i class="fa fa-plus"></i></a>
        <a id="btn_folder" onclick="openNav('nav-search')"><i class="fa fa-folder-open"></i></a>
        <a id="btn_save" class="active" href="#" onclick="closeNav()"><i class="fa fa-floppy-o"></i></a>
        <a href="#" onclick="openNav('nav-calendar')"><i class="fa fa-calendar-check-o"></i></a>    
        <a href="#" onclick="openNav('nav-share')"><i class="fa fa-share-alt"></i></a> 
    </nav>
    <div id="form-area" class="form-area" onclick="closeNav()">
        <form method="post" action="index.php">
            <input type="text" name="note-title" id="note-title" placeholder="Título">
            <input type="text" name="note-tags" id="note-tags" placeholder="tags...">
            <textarea name="note-content" id="note-content" spellcheck="false"></textarea>
        </form>
    </div>
</div>

