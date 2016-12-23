(function()
{
    var titleTags = { h1:1, h2:1, h3:1, h4:1, h5:1, h6:1 };

    function findAllTitles(editor)
    {
        var docRange = new CKEDITOR.dom.range(editor.document),
            walker = new CKEDITOR.dom.walker(docRange),
            next,
            titles = [];
        docRange.selectNodeContents(editor.document.getBody());
        walker.evaluator = function(node)
        {
            if ( node.getName
                && node.getName() in titleTags
                && CKEDITOR.tools.trim( node.getText() ) )
                titles.push( node );
        };
        while ((next = walker.next()))
        {}
        return titles.length ? titles : null;
    }

    function findLastBigger(list, level)
    {
        for (var i = list.length-1 ; i >= 0 ; i--)
        {
            if (list[ i ].level < level)
                return list[ i ];
            if (list[ i ].indent == 0)
                break;
        }
    }

    CKEDITOR.plugins.add( 'toc',
        {
            requires : [ 'list' ],

            init : function(editor)
            {
                editor.addCommand( 'toc',
                    {
                        exec : function(editor)
                        {
                            var list = [],
                            root = new CKEDITOR.dom.element('ol', editor.document),
                            nodes = findAllTitles( editor );
                            root.addClass('table-of-content');

                            for ( var i = 0 ; i < nodes.length ; i++ )
                            {
                                var node = nodes[ i ],
                                    level = parseInt( node.getName().substr( 1 ) ) - 1,
                                    indent = level,
                                    lastBigger = findLastBigger(list, level),
                                    length = list.length;

                                if ( !length || !lastBigger )
                                    indent = 0;
                                else
                                    indent = lastBigger.indent + 1;

                                var text = new CKEDITOR.dom.text(
                                    CKEDITOR.tools.trim(node.getText()), editor.document
                                );

                                list.push(
                                    {
                                        contents : [
                                            text
                                        ],
                                        indent : indent,
                                        parent : root,
                                        element: new CKEDITOR.dom.element('li', editor.document),
                                        level : level
                                    });
                            }

                            var listPlugin = CKEDITOR.plugins.list.arrayToList(list);
                            var listRoot = listPlugin.listNode.getFirst();
                            editor.insertElement(listRoot);
                        }
                    });

                editor.ui.addButton("toc", {
                    label: 'Table of Content',
                    icon: this.path+"toc.png",
                    command: 'toc'
                });
            }
        });
})();