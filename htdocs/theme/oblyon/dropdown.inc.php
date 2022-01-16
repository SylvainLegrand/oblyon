<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>

/* <style type="text/css" > dont remove this line it's an ide hack */
/*
 * Dropdown
 */

.open>.dropdown-menu, .dropdown dd ul.open {
    display: block;
}

.dropdown-menu {
    border-color: #eee;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}

.dropdown-toggle{
    text-decoration: none !important;
}
.dropdown-toggle::after {
    /* font part */
    font-family: "<?php echo getDolGlobalString('MAIN_FONTAWESOME_FAMILY', 'Font Awesome 5 Free'); ?>";
    font-size: 0.7em;
    font-weight: <?php echo getDolGlobalString('MAIN_FONTAWESOME_WEIGHT', '900'); ?>;;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    text-align:center;
    text-decoration:none;
    margin:  auto 3px;
    display: inline-block;
    /*content: "\f078";*/
    -webkit-transition: -webkit-transform .2s ease-in-out;
    -ms-transition: -ms-transform .2s ease-in-out;
     transition: transform .2s ease-in-out;
}

.open>.dropdown-toggle::after {
    transform: rotate(180deg);
}


/*
* MENU Dropdown
*/
.login_block.usedropdown .logout-btn{
    display: none;
}

.tmenu .open.dropdown, .login_block .open.dropdown, .tmenu .open.dropdown, .login_block .dropdown:hover{
    background: rgba(0, 0, 0, 0.1);
}
.tmenu .dropdown-menu, .login_block .dropdown-menu {
    position: absolute;
    right: 0;
    left: -120px;
    line-height:1.3em;
}
.tmenu .dropdown-menu, .login_block  .dropdown-menu .user-body {
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
}
.user-body {
    color: #333;
}
.side-nav-vert .user-menu .dropdown-menu {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
    padding: 1px 0 0 0;
    border-top-width: 0;
    width: 300px;
}
.side-nav-vert .user-menu .dropdown-menu {
    margin-top: 0;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.side-nav-vert .user-menu .dropdown-menu > .user-header {
    min-height: 175px;
    padding: 10px;
    text-align: center;
    white-space: normal;
}

#topmenu-global-search-dropdown .dropdown-menu{
    width: 300px;
    max-width: 100%;
}

.dropdown-user-image {
    border-radius: 50%;
    vertical-align: middle;
    z-index: 5;
    height: 90px;
    width: 90px;
    border: 3px solid;
    border-color: transparent;
    border-color: rgba(255, 255, 255, 0.2);
    max-width: 100%;
    max-height :100%;
}

.dropdown-menu > .user-header{
    background: rgb(<?php echo $colorbackhmenu1 ?>);
}

.dropdown-menu .dropdown-header{
    padding: 5px 10px 10px 10px;
}

.dropdown-menu > .user-footer {
    background-color: #f9f9f9;
    padding: 10px;
}

.user-footer:after {
    clear: both;
}

.dropdown-menu > .bookmark-footer{
    padding: 10px;
}

.dropdown-menu > .user-body, .dropdown-body{
    padding: 15px;
    border-bottom: 1px solid #f4f4f4;
    border-top: 1px solid #dddddd;
    white-space: normal;
}

.dropdown-menu > .bookmark-body, .dropdown-body{
    padding: 10px 0;
    overflow-y: auto;
    max-height: 60vh ; /* fallback for browsers without support for calc() */
    max-height: calc(90vh - 110px) ;
    white-space: normal;
}
#topmenu-bookmark-dropdown .dropdown-menu > .bookmark-body, #topmenu-bookmark-dropdown .dropdown-body{
    max-height: 60vh ; /* fallback for browsers without support for calc() */
    max-height: calc(90vh - 200px) ;
}

.dropdown-body::-webkit-scrollbar {
    width: 8px;
}
.dropdown-body::-webkit-scrollbar-thumb {
    -webkit-border-radius: 0;
    border-radius: 0;
    background: rgb(<?php echo $colorbackhmenu1 ?>);
}
.dropdown-body::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -webkit-border-radius: 0;
    border-radius: 0;
    background: #aaa;
}

#topmenu-login-dropdown, #topmenu-bookmark-dropdown, #topmenu-quickadd-dropdown, #topmenu-global-search-dropdown, #topmenu-tool-dropdown {
    padding: 0 5px 0 5px;
}
#topmenu-login-dropdown a:hover{
    text-decoration: none;
}

#topmenuloginmoreinfo-btn, #topmenulogincompanyinfo-btn {
    display: block;
    text-aling: right;
    color:#666;
    cursor: pointer;
}

#topmenuloginmoreinfo, #topmenulogincompanyinfo {
    display: none;
    clear: both;
    font-size: 0.95em;
}

.button-top-menu-dropdown {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}

.user-footer .button-top-menu-dropdown {
    color: #666666;
    border-radius: 0;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border-width: 1px;
    background-color: #f4f4f4;
    border-color: #ddd;
}

    .dropdown-menu a.top-menu-dropdown-link {
        color: rgb(<?php print $colortextlink; ?>) !important;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        display: block;
        margin: 5px 0px;
    }
    .dropdown-item {
        display: block !important;
        box-sizing: border-box;
        width: 100%;
        padding: .25rem 1.5rem .25rem 1rem;
        clear: both;
        font-weight: 400;
        color: #212529  !important;
        text-align: inherit;
        background-color: transparent;
        border: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }
    .dropdown-item::before {
        /* font part */
        font-family: "<?php echo getDolGlobalString('MAIN_FONTAWESOME_FAMILY', 'Font Awesome 5 Free'); ?>";
        font-weight: <?php echo getDolGlobalString('MAIN_FONTAWESOME_WEIGHT', '900'); ?>;;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        text-align:center;
        text-decoration:none;
        margin-right: 5px;
        display: inline-block;
        content: "\f0da";
        color: rgba(0,0,0,0.3);
    }
    .dropdown-item.active, .dropdown-item:hover, .dropdown-item:focus  {
        color: #000000 !important;
        text-decoration: none;
        background: rgb(<?php echo $colorbackhmenu1 ?>);
    }
    /*
     * SEARCH
     */
    .dropdown-search-input {
        width: 100%;
        padding: 10px 35px 10px 20px;
        background-color: transparent;
        font-size: 14px;
        line-height: 16px;
        box-sizing: border-box;
        color: #575756;
        background-color: transparent;
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 16px 16px;
        background-position: 95% center;
        border-radius: 50px;
        border: 1px solid #c4c4c2 !important;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }
    .dropdown-search-input::placeholder {
        color: color(#575756 a(0.8));
        letter-spacing: 1.5px;
    }
    .hidden-search-result{
        display: none !important;
    }

    /*
     * QUICK ADD
     */
    #topmenu-quickadd-dropdown .dropdown-menu {
        width: 335px !important;
        color: #444;
    }

    .quickadd-header {
        color: #444 !important;
    }

    div.quickadd {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-align-content: center;
        -ms-flex-line-pack: center;
        align-content: center;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    div.quickadd a {
        color: #444;
		height: 60px;
		width: 110px;
    }

    div.quickadd a:hover, div.quickadd a:active {
        color: <?php print $bgnavtop_txt; ?>;
    }

    div.quickaddblock {
        width: 110px;
        display: block ruby;
    }

    div.quickaddblock:hover,
    div.quickaddblock:active,
    div.quickaddblock:focus {
        background: <?php print $maincolor; ?>;
    }

    /*
     * Responsive
     */
    @media only screen and (max-width: 570px) {
        #topmenu-login-dropdown, #topmenu-bookmark-dropdown, #topmenu-quickadd-dropdown, #topmenu-global-search-dropdown, #topmenu-tool-dropdown {
            padding: 0 2px 0 2px;
        }
    }
