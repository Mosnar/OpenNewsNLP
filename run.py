import sys, os, shutil
from subprocess import call

lib_dir = 'lib'
output_dir = 'output'
temp_dir = 'temp'

command = 'java -Xmx1g -classpath ./lib/weka.jar:./lib/stanford-postagger.jar:opinionfinder.jar ' \
          'opin.main.RunOpinionFinder %s >/dev/null 2>&1'

header = '''<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../markup.css">
</head>
'''

def cleanup(path):
    shutil.rmtree(path)


def view(filepath):
    open_cmd = 'open %s' % filepath
    call(open_cmd, shell=True)


def postprocess(outname, filepath):
    global output_dir, header

    if not os.path.exists(filepath):
        print 'err: no markup file found at %s' % filepath

    outpath = os.path.join(output_dir, outname + '.html')
    newfile = open(outpath, 'w')
    oldfile = open(filepath, 'r')
    newfile.write(header)
    newfile.writelines([l for l in oldfile.readlines()])
    print 'Done!'

    view(outpath)


def find_opinions(filepath, clean=True):
    print 'Running...'
    global lib_dir, command
    abspath = os.path.abspath(filepath)

    if not os.path.exists(abspath):
        print 'invalid file'
        return

    command %= abspath

    try:
        call(command, shell=True, cwd=lib_dir)
    except:
        print 'err: exception while running opinionfinder'

    genpath = '%s_auto_anns' % abspath
    newpath = '%s/markup.txt' % genpath

    newname = os.path.splitext(os.path.basename(filepath))[0]

    postprocess(newname, newpath)

def temp_copy(filepath):
    abspath = os.path.abspath(filepath)
    if not os.path.exists(abspath):
        print 'invalid file'
        return (None, None)

    abspath = os.path.abspath(filepath)
    filename = os.path.basename(filepath)
    tempabsdir = os.path.abspath(os.path.join(os.getcwd(), temp_dir))

    if not os.path.exists(tempabsdir):
        os.makedirs(tempabsdir)

    tempabspath = os.path.join(tempabsdir, filename)
    shutil.copy(abspath, tempabspath)
    return (tempabspath, tempabsdir)

if len(sys.argv) >= 2:
    clean = '--noclean' not in sys.argv

    (newpath, tempdir) = temp_copy(sys.argv[1])

    if newpath is not None:
        find_opinions(newpath)
        if clean:
            cleanup(tempdir)
else:
    print 'invalid syntax'
    print 'use: python run.py <file>'
