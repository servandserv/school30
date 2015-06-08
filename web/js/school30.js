function resize_docs_container(docs, cols) {
    if( screen.availWidth < 1024 || window.innerWidth < 1024 ) return;
    var h = summator = 0;
    var cols = cols || 3;
    var files = []
    var columns = [];
    var best = { range:9999999999999, max:0 };
    var max, min, range, avg;
    
    for(var i=0;i<docs.childNodes.length;i++) {
        if(docs.childNodes[i].offsetHeight) {
            files.push(docs.childNodes[i].offsetHeight+1);
            h += docs.childNodes[i].offsetHeight;
        }
    }
    //if( docs.childNodes.length < 6 ) cols = 3;
    //if( docs.childNodes.length == 1 ) cols = 3;
    
    avg = h / cols;
    if(files.length <= cols ) {
        best.max = Math.max.apply(null, files);
    } else {
        switch(cols) {
            case 2:
                best = max2col(files,best);
                break;
            case 4:
                best = max4col(files,best);
                break;
            default:
                best = max3col(files,best);
        }
    }
    docs.style.height = best.max  + 'px';
}

function columns() {
    if( window.innerWidth >= 2048 ) return 4;
    else if( window.innerWidth < 1200 ) return 2;
    else return 3;
}

function max3col(files,best) {
    var columns = [];
    for(var i=1;i<=files.length - 2;i++) {
        for(var j = i+1; j <= files.length - 1; j++) {
            for(var k = j + 1; k <= files.length; k++) {
                columns.push(files.slice(0,i).reduce(function(a, b) { return a + b; }));
                columns.push(files.slice(i,j).reduce(function(a, b) { return a + b; }));
                columns.push(files.slice(j).reduce(function(a, b) { return a + b; }));
                
                max = Math.max.apply(null, columns);
                min = Math.min.apply(null, columns);
                
                range = max - min;
                if(best.range > range) {
                    best.range = range;
                    best.max = max;
                }
                columns = [];
            }
        }
    }
    return best;
}

function max4col(files,best) {
    var columns = [];
    for(var i=1;i<=files.length - 3;i++) {
        for(var j = i+1; j <= files.length - 2; j++) {
            for(var k = j + 1; k <= files.length - 1; k++) {
                for(var l = k + 1; l <= files.length; l++) {
                    columns.push(files.slice(0,i).reduce(function(a, b) { return a + b; }));
                    columns.push(files.slice(i,j).reduce(function(a, b) { return a + b; }));
                    columns.push(files.slice(j,k).reduce(function(a, b) { return a + b; }));
                    columns.push(files.slice(k).reduce(function(a, b) { return a + b; }));
                
                    max = Math.max.apply(null, columns);
                    min = Math.min.apply(null, columns);
                
                    range = max - min;
                    if(best.range > range) {
                        best.range = range;
                        best.max = max;
                    }
                
                    columns = [];
                }
            }
        }
    }
    return best;
}

function max2col(files,best) {
    var columns = [];
    for(var i=1;i<=files.length - 1;i++) {
        for(var j = i+1; j <= files.length; j++) {
            columns.push(files.slice(0,i).reduce(function(a, b) { return a + b; }));
            columns.push(files.slice(i).reduce(function(a, b) { return a + b; }));
            
            max = Math.max.apply(null, columns);
            min = Math.min.apply(null, columns);
                
            range = max - min;
            if(best.range > range) {
                best.range = range;
                best.max = max;
            }
            columns = [];
        }
    }
    return best;
}