# Work with plugins

<a href="https://en.m.wikipedia.org/wiki/Plug-in_(computing)"> What is plug-in? </a>

you can add plugin in folder config/plugins

<b> Start Work 🔘 </b>
<pre>$AntarP = new ASA_plugins(array filenames = []);</pre>
<h6> Examples : </h6>
<pre>$AntarP = new ASA_plugins(['functions.php','config.php']);</pre>

<b> Load Folder plugin 👇 </b>
<pre>$AntarP->PluginLoad($folder, $file);</pre>
<h4> A guide to working with the above function 👇 </h6>
<h5> What is $folder ? </h5>
<h6> Enter the folder name in which you have the plugin 😎👌 </h6>
<h5> What is $file ? </h5>
<h6> The original file name that attaches to other items in the folder (main file this plugin) ❇ </h6>

<b> Direct connection to GitHab 👇 </b>
<pre>$AntarP->github($username, $repository, $plugin);</pre>
<h5> What is $plugin ? </h5
<h6> main file this plugin! </h6>
<h5> Example : </h5>
<pre>$AntarP->github("KyleAMathews","phpmailer","class.phpmailer.php");</pre>
<h6> for install and include phpmailer </h6>
