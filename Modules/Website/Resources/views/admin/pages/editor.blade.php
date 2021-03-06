<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Admin 4.0</title>
  <link rel="stylesheet" href="/public/grapesjs/toastr.min.css">
  <link rel="stylesheet" href="/public/grapesjs/grapes.min.css?v0.16.18">
  <link rel="stylesheet" href="/public/grapesjs/grapesjs-preset-webpage.min.css">
  <link rel="stylesheet" href="/public/grapesjs/tooltip.css">
  <link rel="stylesheet" href="/public/grapesjs/grapesjs-plugin-filestack.css">
  <link rel="stylesheet" href="/public/grapesjs/demos.css?v3">
  <link href="/public/grapesjs/grapick.min.css" rel="stylesheet">

  <script src="/public/grapesjs/jquery.min.js"></script>
  <script src="/public/grapesjs/toastr.min.js"></script>

  <script src="/public/grapesjs/grapes.min.js?v0.16.18"></script>
  <script src="/public/grapesjs/grapesjs-preset-webpage.min.js?v0.1.11"></script>
  <script src="/public/grapesjs/grapesjs-lory-slider.min.js?0.1.5"></script>
  <script src="/public/grapesjs/grapesjs-tabs.min.js?0.1.1"></script>
  <script src="/public/grapesjs/grapesjs-custom-code.min.js?0.1.2"></script>
  <script src="/public/grapesjs/grapesjs-touch.min.js?0.1.1"></script>
  <script src="/public/grapesjs/grapesjs-parser-postcss.min.js?0.1.1"></script>
  <script src="/public/grapesjs/grapesjs-tooltip.min.js?0.1.1"></script>
  <script src="/public/grapesjs/grapesjs-tui-image-editor.min.js?0.1.2"></script>
  <script src="/public/grapesjs/grapesjs-typed.min.js?1.0.5"></script>
  <script src="/public/grapesjs/grapesjs-style-bg.min.js?1.0.1"></script>
  <style type="text/css">
  .icon-add-comp::before, .icon-comp100::before,.icon-comp50::before,.icon-comp30::before,.icon-rm::before{ content: '';}
  .icon-add-comp {
    background: url("/public/grapesjs/icon-sq-a.png") no-repeat center;
  }
  .icon-comp100 {
    background: url("/public/grapesjs/icon-sq-1.png") no-repeat center;
  }
  .icon-comp50 {
    background: url("/public/grapesjs/icon-sq-2.png") no-repeat center;
  }
  .icon-comp30 {
    background: url("/public/grapesjs/icon-sq-3.png") no-repeat center;
  }
  .icon-rm {
    background: url("/public/grapesjs/icon-sq-r.png") no-repeat center;
  }
  .icons-flex {
    background-size: 70% 65% !important;
    height: 15px;
    width: 17px;
    opacity: 0.9;
  }
  .icon-dir-row {
    background: url("/public/grapesjs/flex-dir-row.png") no-repeat center;
  }
  .icon-dir-row-rev {
    background: url("/public/grapesjs/flex-dir-row-rev.png") no-repeat center;
  }
  .icon-dir-col {
    background: url("/public/grapesjs/flex-dir-col.png") no-repeat center;
  }
  .icon-dir-col-rev {
    background: url("/public/grapesjs/flex-dir-col-rev.png") no-repeat center;
  }
  .icon-just-start{
   background: url("/public/grapesjs/flex-just-start.png") no-repeat center;
 }
 .icon-just-end{
   background: url("/public/grapesjs/flex-just-end.png") no-repeat center;
 }
 .icon-just-sp-bet{
   background: url("/public/grapesjs/flex-just-sp-bet.png") no-repeat center;
 }
 .icon-just-sp-ar{
   background: url("/public/grapesjs/flex-just-sp-ar.png") no-repeat center;
 }
 .icon-just-sp-cent{
   background: url("/public/grapesjs/flex-just-sp-cent.png") no-repeat center;
 }
 .icon-al-start{
   background: url("/public/grapesjs/flex-al-start.png") no-repeat center;
 }
 .icon-al-end{
   background: url("/public/grapesjs/flex-al-end.png") no-repeat center;
 }
 .icon-al-str{
   background: url("/public/grapesjs/flex-al-str.png") no-repeat center;
 }
 .icon-al-center{
   background: url("/public/grapesjs/flex-al-center.png") no-repeat center;
 }
 [data-tooltip]::after {
   background: rgba(51, 51, 51, 0.9);
 }
 .gjs-pn-commands {
   min-height: 40px;
 }
 #gjs-sm-float,
 .gjs-pn-views .fa-cog {
  display: none;
}
.gjs-am-preview-cont {
 height: 100px;
 width: 100%;
}
.gjs-logo-version {
 background-color: #756467;
}
.gjs-pn-panel.gjs-pn-views {
  padding: 0;
  border-bottom: none;
}
.gjs-pn-btn.gjs-pn-active {
  box-shadow: none;
}
.gjs-pn-views .gjs-pn-btn {
  margin: 0;
  height: 40px;
  padding: 10px;
  width: 33.3333%;
  border-bottom: 2px solid rgba(0, 0, 0, 0.3);
}
.CodeMirror {
  min-height: 450px;
  margin-bottom: 8px;
}
.grp-handler-close {
  background-color: transparent;
  color: #ddd;
}
.grp-handler-cp-wrap {
  border-color: transparent;
}
</style>

</head>
<body>
  <div id="gjs" style="height:0px; overflow:hidden"></div>


  <script type="text/javascript">
  var editor  = grapesjs.init({
    avoidInlineStyle: 1,
    height: '100%',
    container : '#gjs',
    fromElement: 1,
    showOffsets: 1,
    assetManager: {
      embedAsBase64: 1,
      assets: []
    },
    selectorManager: { componentFirst: true },
    styleManager: { clearProperties: 1 },
    plugins: [
    'grapesjs-lory-slider',
    'grapesjs-tabs',
    'grapesjs-custom-code',
    'grapesjs-touch',
    'grapesjs-parser-postcss',
    'grapesjs-tooltip',
    'grapesjs-tui-image-editor',
    'grapesjs-typed',
    'grapesjs-style-bg',
    'gjs-preset-webpage',
    ],
    pluginsOpts: {
      'grapesjs-lory-slider': {
        sliderBlock: {
          category: 'Extra'
        }
      },
      'grapesjs-tabs': {
        tabsBlock: {
          category: 'Extra'
        }
      },
      'grapesjs-typed': {
        block: {
          category: 'Extra',
          content: {
            type: 'typed',
            'type-speed': 40,
            strings: [
            'Text row one',
            'Text row two',
            'Text row three',
            ],
          }
        }
      },
      'gjs-preset-webpage': {
        modalImportTitle: 'Import Template',
        modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
        modalImportContent: function(editor) {
          return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
        },
            filestackOpts: null, //{ key: 'AYmqZc2e8RLGLE7TGkX3Hz' },
            aviaryOpts: false,
            blocksBasicOpts: { flexGrid: 1 },
            customStyleManager: [{
              name: 'General',
              buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
              properties:[{
                name: 'Alignment',
                property: 'float',
                type: 'radio',
                defaults: 'none',
                list: [
                { value: 'none', className: 'fa fa-times'},
                { value: 'left', className: 'fa fa-align-left'},
                { value: 'right', className: 'fa fa-align-right'}
                ],
              },
              { property: 'position', type: 'select'}
              ],
            },{
              name: 'Dimension',
              open: false,
              buildProps: ['width', 'flex-width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
              properties: [{
                id: 'flex-width',
                type: 'integer',
                name: 'Width',
                units: ['px', '%'],
                property: 'flex-basis',
                toRequire: 1,
              },{
                property: 'margin',
                properties:[
                { name: 'Top', property: 'margin-top'},
                { name: 'Right', property: 'margin-right'},
                { name: 'Bottom', property: 'margin-bottom'},
                { name: 'Left', property: 'margin-left'}
                ],
              },{
                property  : 'padding',
                properties:[
                { name: 'Top', property: 'padding-top'},
                { name: 'Right', property: 'padding-right'},
                { name: 'Bottom', property: 'padding-bottom'},
                { name: 'Left', property: 'padding-left'}
                ],
              }],
            },{
              name: 'Typography',
              open: false,
              buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow'],
              properties:[
              { name: 'Font', property: 'font-family'},
              { name: 'Weight', property: 'font-weight'},
              { name:  'Font color', property: 'color'},
              {
                property: 'text-align',
                type: 'radio',
                defaults: 'left',
                list: [
                { value : 'left',  name : 'Left',    className: 'fa fa-align-left'},
                { value : 'center',  name : 'Center',  className: 'fa fa-align-center' },
                { value : 'right',   name : 'Right',   className: 'fa fa-align-right'},
                { value : 'justify', name : 'Justify',   className: 'fa fa-align-justify'}
                ],
              },{
                property: 'text-decoration',
                type: 'radio',
                defaults: 'none',
                list: [
                { value: 'none', name: 'None', className: 'fa fa-times'},
                { value: 'underline', name: 'underline', className: 'fa fa-underline' },
                { value: 'line-through', name: 'Line-through', className: 'fa fa-strikethrough'}
                ],
              },{
                property: 'text-shadow',
                properties: [
                { name: 'X position', property: 'text-shadow-h'},
                { name: 'Y position', property: 'text-shadow-v'},
                { name: 'Blur', property: 'text-shadow-blur'},
                { name: 'Color', property: 'text-shadow-color'}
                ],
              }],
            },{
              name: 'Decorations',
              open: false,
              buildProps: ['opacity', 'border-radius', 'border', 'box-shadow', 'background-bg'],
              properties: [{
                type: 'slider',
                property: 'opacity',
                defaults: 1,
                step: 0.01,
                max: 1,
                min:0,
              },{
                property: 'border-radius',
                properties  : [
                { name: 'Top', property: 'border-top-left-radius'},
                { name: 'Right', property: 'border-top-right-radius'},
                { name: 'Bottom', property: 'border-bottom-left-radius'},
                { name: 'Left', property: 'border-bottom-right-radius'}
                ],
              },{
                property: 'box-shadow',
                properties: [
                { name: 'X position', property: 'box-shadow-h'},
                { name: 'Y position', property: 'box-shadow-v'},
                { name: 'Blur', property: 'box-shadow-blur'},
                { name: 'Spread', property: 'box-shadow-spread'},
                { name: 'Color', property: 'box-shadow-color'},
                { name: 'Shadow type', property: 'box-shadow-type'}
                ],
              },{
                id: 'background-bg',
                property: 'background',
                type: 'bg',
              },],
            },{
              name: 'Extra',
              open: false,
              buildProps: ['transition', 'perspective', 'transform'],
              properties: [{
                property: 'transition',
                properties:[
                { name: 'Property', property: 'transition-property'},
                { name: 'Duration', property: 'transition-duration'},
                { name: 'Easing', property: 'transition-timing-function'}
                ],
              },{
                property: 'transform',
                properties:[
                { name: 'Rotate X', property: 'transform-rotate-x'},
                { name: 'Rotate Y', property: 'transform-rotate-y'},
                { name: 'Rotate Z', property: 'transform-rotate-z'},
                { name: 'Scale X', property: 'transform-scale-x'},
                { name: 'Scale Y', property: 'transform-scale-y'},
                { name: 'Scale Z', property: 'transform-scale-z'}
                ],
              }]
            },{
              name: 'Flex',
              open: false,
              properties: [{
                name: 'Flex Container',
                property: 'display',
                type: 'select',
                defaults: 'block',
                list: [
                { value: 'block', name: 'Disable'},
                { value: 'flex', name: 'Enable'}
                ],
              },{
                name: 'Flex Parent',
                property: 'label-parent-flex',
                type: 'integer',
              },{
                name      : 'Direction',
                property  : 'flex-direction',
                type    : 'radio',
                defaults  : 'row',
                list    : [{
                  value   : 'row',
                  name    : 'Row',
                  className : 'icons-flex icon-dir-row',
                  title   : 'Row',
                },{
                  value   : 'row-reverse',
                  name    : 'Row reverse',
                  className : 'icons-flex icon-dir-row-rev',
                  title   : 'Row reverse',
                },{
                  value   : 'column',
                  name    : 'Column',
                  title   : 'Column',
                  className : 'icons-flex icon-dir-col',
                },{
                  value   : 'column-reverse',
                  name    : 'Column reverse',
                  title   : 'Column reverse',
                  className : 'icons-flex icon-dir-col-rev',
                }],
              },{
                name      : 'Justify',
                property  : 'justify-content',
                type    : 'radio',
                defaults  : 'flex-start',
                list    : [{
                  value   : 'flex-start',
                  className : 'icons-flex icon-just-start',
                  title   : 'Start',
                },{
                  value   : 'flex-end',
                  title    : 'End',
                  className : 'icons-flex icon-just-end',
                },{
                  value   : 'space-between',
                  title    : 'Space between',
                  className : 'icons-flex icon-just-sp-bet',
                },{
                  value   : 'space-around',
                  title    : 'Space around',
                  className : 'icons-flex icon-just-sp-ar',
                },{
                  value   : 'center',
                  title    : 'Center',
                  className : 'icons-flex icon-just-sp-cent',
                }],
              },{
                name      : 'Align',
                property  : 'align-items',
                type    : 'radio',
                defaults  : 'center',
                list    : [{
                  value   : 'flex-start',
                  title    : 'Start',
                  className : 'icons-flex icon-al-start',
                },{
                  value   : 'flex-end',
                  title    : 'End',
                  className : 'icons-flex icon-al-end',
                },{
                  value   : 'stretch',
                  title    : 'Stretch',
                  className : 'icons-flex icon-al-str',
                },{
                  value   : 'center',
                  title    : 'Center',
                  className : 'icons-flex icon-al-center',
                }],
              },{
                name: 'Flex Children',
                property: 'label-parent-flex',
                type: 'integer',
              },{
                name:     'Order',
                property:   'order',
                type:     'integer',
                defaults :  0,
                min: 0
              },{
                name    : 'Flex',
                property  : 'flex',
                type    : 'composite',
                properties  : [{
                  name:     'Grow',
                  property:   'flex-grow',
                  type:     'integer',
                  defaults :  0,
                  min: 0
                },{
                  name:     'Shrink',
                  property:   'flex-shrink',
                  type:     'integer',
                  defaults :  0,
                  min: 0
                },{
                  name:     'Basis',
                  property:   'flex-basis',
                  type:     'integer',
                  units:    ['px','%',''],
                  unit: '',
                  defaults :  'auto',
                }],
              },{
                name      : 'Align',
                property  : 'align-self',
                type      : 'radio',
                defaults  : 'auto',
                list    : [{
                  value   : 'auto',
                  name    : 'Auto',
                },{
                  value   : 'flex-start',
                  title    : 'Start',
                  className : 'icons-flex icon-al-start',
                },{
                  value   : 'flex-end',
                  title    : 'End',
                  className : 'icons-flex icon-al-end',
                },{
                  value   : 'stretch',
                  title    : 'Stretch',
                  className : 'icons-flex icon-al-str',
                },{
                  value   : 'center',
                  title    : 'Center',
                  className : 'icons-flex icon-al-center',
                }],
              }]
            }
            ],
          },
        },
      });

editor.I18n.addMessages({
  en: {
    styleManager: {
      properties: {
        'background-repeat': 'Repeat',
        'background-position': 'Position',
        'background-attachment': 'Attachment',
        'background-size': 'Size',
      }
    },
  }
});

var pn = editor.Panels;
var modal = editor.Modal;
var cmdm = editor.Commands;
cmdm.add('canvas-clear', function() {
  if(confirm('Areeee you sure to clean the canvas?')) {
    var comps = editor.DomComponents.clear();
    setTimeout(function(){ localStorage.clear()}, 0)
  }
});
cmdm.add('set-device-desktop', {
  run: function(ed) { ed.setDevice('Desktop') },
  stop: function() {},
});
cmdm.add('set-device-tablet', {
  run: function(ed) { ed.setDevice('Tablet') },
  stop: function() {},
});
cmdm.add('set-device-mobile', {
  run: function(ed) { ed.setDevice('Mobile portrait') },
  stop: function() {},
});



      // Add info command
      var mdlClass = 'gjs-mdl-dialog-sm';
      var infoContainer = document.getElementById('info-panel');
      cmdm.add('open-info', function() {
        var mdlDialog = document.querySelector('.gjs-mdl-dialog');
        mdlDialog.className += ' ' + mdlClass;
        infoContainer.style.display = 'block';
        modal.setTitle('About this demo');
        modal.setContent(infoContainer);
        modal.open();
        modal.getModel().once('change:open', function() {
          mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
        })
      });
      pn.addButton('options', {
        id: 'open-info',
        className: 'fa fa-question-circle',
        command: function() { editor.runCommand('open-info') },
        attributes: {
          'title': 'About',
          'data-tooltip-pos': 'bottom',
        },
      });


      // Simple warn notifier
      var origWarn = console.warn;
      toastr.options = {
        closeButton: true,
        preventDuplicates: true,
        showDuration: 250,
        hideDuration: 150
      };
      console.warn = function (msg) {
        if (msg.indexOf('[undefined]') == -1) {
          toastr.warning(msg);
        }
        origWarn(msg);
      };


      // Add and beautify tooltips
      [['sw-visibility', 'Show Borders'], ['preview', 'Preview'], ['fullscreen', 'Fullscreen'],
      ['export-template', 'Export'], ['undo', 'Undo'], ['redo', 'Redo'],
      ['gjs-open-import-webpage', 'Import'], ['canvas-clear', 'Clear canvas']]
      .forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      [['open-sm', 'Style Manager'], ['open-layers', 'Layers'], ['open-blocks', 'Blocks']]
      .forEach(function(item) {
        pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      var titles = document.querySelectorAll('*[title]');

      for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim(): '';
        if(!title)
          break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
      }

      // Show borders by default
      pn.getButton('options', 'sw-visibility').set('active', 1);


      // Store and load events
      editor.on('storage:load', function(e) { console.log('Loaded ', e) });
      editor.on('storage:store', function(e) { console.log('Stored ', e) });

      console.log(localStorage.getItem("gjs-html"));

      $('.gjs-pn-devices-c .gjs-pn-buttons').append('<span class="gjs-pn-btn fa fa-save" onClick="saveTheme()" style="background:#000;">  <strong style="font-size:12px;">Save</strong> </span>');

      function saveTheme() {
        var html = '<style>'+localStorage.getItem("gjs-css")+'</style>';
        html += localStorage.getItem("gjs-html");
        console.log(html);
      }
      </script>
    </body>
    </html>
