# 🧹🍳 PHP-CS-Fixer Heredoc/Nowdoc Formatter Recipes

This project showcases [PHP-CS-Fixer] [`uuf6429/php-cs-fixer-blockstring`] configurations for integrating various
3rd-party formatters. To ensure long-term correctness, all configurations (and the relevant 3rd-party tools) are tested.

You are of course welcome to request or add your own integrations.

> [!WARNING]
> **Disclaimer:** This repository provides example integrations for **third-party** tools.
>
> The author does not **maintain**, **audit**, or **endorse** these tools. You are responsible for
> verifying their **licensing**, **security**, and any **privacy** or **data collection** implications.
>
> _Use all third-party tools at your own risk._

## Recipes

### Blade

<table><tr><td><code>shufo/blade-formatter</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/blade-formatter/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;BLADE&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;blade-formatter --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;blade-formatter --stdin&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/Blade/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;BLADE&#039;
───→@extends(&#039;frontend.layouts.app&#039;)
───→@section(&#039;title&#039;)·foo
───→@endsection
───→@section(&#039;content&#039;)
───→&lt;section·id=&quot;content&quot;&gt;
───→&lt;div·class=&quot;container·mod-users-pd-h&quot;&gt;
───→····&lt;div·class=&quot;pf-user-header&quot;&gt;
───→····&lt;div&gt;&lt;/div&gt;
───→····&lt;p&gt;@lang(&#039;users.index&#039;)&lt;/p&gt;
───→····&lt;/div&gt;
───→········&lt;div·class=&quot;pf-users-branch&quot;&gt;
───→············&lt;ul·class=&quot;pf-users-branch__list&quot;&gt;
───→················@foreach($users·as·$user)
───→········&lt;li&gt;
───→············&lt;img·src=&quot;{{·asset(&#039;img/frontend/icon/branch-arrow.svg&#039;)·}}&quot;·alt=&quot;branch_arrow&quot;&gt;
───→············{{·link_to_route(&quot;frontend.users.user.show&quot;,$users[&quot;name&quot;],$users[&#039;_id&#039;])·}}
───→········&lt;/li&gt;
───→········@endforeach
───→······&lt;/ul&gt;
───→······&lt;div·class=&quot;pf-users-branch__btn&quot;&gt;
───→······@can(&#039;create&#039;,·App\Models\User::class)
───→············{!!·link_to_route(&quot;frontend.users.user.create&quot;,__(&#039;users.create&#039;),[1,2,3],[&#039;class&#039;·=&gt;·&#039;btn&#039;])·!!}
───→············@endcan
───→········&lt;/div&gt;
───→··&lt;/div&gt;
───→····&lt;/div&gt;
───→&lt;/section&gt;
───→@endsection
───→@section(&#039;footer&#039;)
───→@stop
───→BLADE;
</pre></td><td>Formatted Output (<a href="./recipes/cases/Blade/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;BLADE&#039;
───→@extends(&#039;frontend.layouts.app&#039;)
───→@section(&#039;title&#039;)·foo
───→@endsection
───→@section(&#039;content&#039;)
───→····&lt;section·id=&quot;content&quot;&gt;
───→········&lt;div·class=&quot;container·mod-users-pd-h&quot;&gt;
───→············&lt;div·class=&quot;pf-user-header&quot;&gt;
───→················&lt;div&gt;&lt;/div&gt;
───→················&lt;p&gt;@lang(&#039;users.index&#039;)&lt;/p&gt;
───→············&lt;/div&gt;
───→············&lt;div·class=&quot;pf-users-branch&quot;&gt;
───→················&lt;ul·class=&quot;pf-users-branch__list&quot;&gt;
───→····················@foreach·($users·as·$user)
───→························&lt;li&gt;
───→····························&lt;img·src=&quot;{{·asset(&#039;img/frontend/icon/branch-arrow.svg&#039;)·}}&quot;·alt=&quot;branch_arrow&quot;&gt;
───→····························{{·link_to_route(&#039;frontend.users.user.show&#039;,·$users[&#039;name&#039;],·$users[&#039;_id&#039;])·}}
───→························&lt;/li&gt;
───→····················@endforeach
───→················&lt;/ul&gt;
───→················&lt;div·class=&quot;pf-users-branch__btn&quot;&gt;
───→····················@can(&#039;create&#039;,·App\Models\User::class)
───→························{!!·link_to_route(&#039;frontend.users.user.create&#039;,·__(&#039;users.create&#039;),·[1,·2,·3],·[&#039;class&#039;·=&gt;·&#039;btn&#039;])·!!}
───→····················@endcan
───→················&lt;/div&gt;
───→············&lt;/div&gt;
───→········&lt;/div&gt;
───→····&lt;/section&gt;
───→@endsection
───→@section(&#039;footer&#039;)
───→@stop
───→BLADE;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>docker</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/docker/blade-formatter/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\DockerPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;BLADE&#039; =&gt; new DockerPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;image: &#039;shufo/blade-formatter&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;command: [&#039;--stdin&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pullMode: &#039;missing&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/Blade/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;BLADE&#039;
───→@extends(&#039;frontend.layouts.app&#039;)
───→@section(&#039;title&#039;)·foo
───→@endsection
───→@section(&#039;content&#039;)
───→&lt;section·id=&quot;content&quot;&gt;
───→&lt;div·class=&quot;container·mod-users-pd-h&quot;&gt;
───→····&lt;div·class=&quot;pf-user-header&quot;&gt;
───→····&lt;div&gt;&lt;/div&gt;
───→····&lt;p&gt;@lang(&#039;users.index&#039;)&lt;/p&gt;
───→····&lt;/div&gt;
───→········&lt;div·class=&quot;pf-users-branch&quot;&gt;
───→············&lt;ul·class=&quot;pf-users-branch__list&quot;&gt;
───→················@foreach($users·as·$user)
───→········&lt;li&gt;
───→············&lt;img·src=&quot;{{·asset(&#039;img/frontend/icon/branch-arrow.svg&#039;)·}}&quot;·alt=&quot;branch_arrow&quot;&gt;
───→············{{·link_to_route(&quot;frontend.users.user.show&quot;,$users[&quot;name&quot;],$users[&#039;_id&#039;])·}}
───→········&lt;/li&gt;
───→········@endforeach
───→······&lt;/ul&gt;
───→······&lt;div·class=&quot;pf-users-branch__btn&quot;&gt;
───→······@can(&#039;create&#039;,·App\Models\User::class)
───→············{!!·link_to_route(&quot;frontend.users.user.create&quot;,__(&#039;users.create&#039;),[1,2,3],[&#039;class&#039;·=&gt;·&#039;btn&#039;])·!!}
───→············@endcan
───→········&lt;/div&gt;
───→··&lt;/div&gt;
───→····&lt;/div&gt;
───→&lt;/section&gt;
───→@endsection
───→@section(&#039;footer&#039;)
───→@stop
───→BLADE;
</pre></td><td>Formatted Output (<a href="./recipes/cases/Blade/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;BLADE&#039;
───→@extends(&#039;frontend.layouts.app&#039;)
───→@section(&#039;title&#039;)·foo
───→@endsection
───→@section(&#039;content&#039;)
───→····&lt;section·id=&quot;content&quot;&gt;
───→········&lt;div·class=&quot;container·mod-users-pd-h&quot;&gt;
───→············&lt;div·class=&quot;pf-user-header&quot;&gt;
───→················&lt;div&gt;&lt;/div&gt;
───→················&lt;p&gt;@lang(&#039;users.index&#039;)&lt;/p&gt;
───→············&lt;/div&gt;
───→············&lt;div·class=&quot;pf-users-branch&quot;&gt;
───→················&lt;ul·class=&quot;pf-users-branch__list&quot;&gt;
───→····················@foreach·($users·as·$user)
───→························&lt;li&gt;
───→····························&lt;img·src=&quot;{{·asset(&#039;img/frontend/icon/branch-arrow.svg&#039;)·}}&quot;·alt=&quot;branch_arrow&quot;&gt;
───→····························{{·link_to_route(&#039;frontend.users.user.show&#039;,·$users[&#039;name&#039;],·$users[&#039;_id&#039;])·}}
───→························&lt;/li&gt;
───→····················@endforeach
───→················&lt;/ul&gt;
───→················&lt;div·class=&quot;pf-users-branch__btn&quot;&gt;
───→····················@can(&#039;create&#039;,·App\Models\User::class)
───→························{!!·link_to_route(&#039;frontend.users.user.create&#039;,·__(&#039;users.create&#039;),·[1,·2,·3],·[&#039;class&#039;·=&gt;·&#039;btn&#039;])·!!}
───→····················@endcan
───→················&lt;/div&gt;
───→············&lt;/div&gt;
───→········&lt;/div&gt;
───→····&lt;/section&gt;
───→@endsection
───→@section(&#039;footer&#039;)
───→@stop
───→BLADE;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/blade-formatter/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;BLADE&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;blade-formatter --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;blade-formatter --stdin&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/Blade/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;BLADE&#039;
───→@extends(&#039;frontend.layouts.app&#039;)
───→@section(&#039;title&#039;)·foo
───→@endsection
───→@section(&#039;content&#039;)
───→&lt;section·id=&quot;content&quot;&gt;
───→&lt;div·class=&quot;container·mod-users-pd-h&quot;&gt;
───→····&lt;div·class=&quot;pf-user-header&quot;&gt;
───→····&lt;div&gt;&lt;/div&gt;
───→····&lt;p&gt;@lang(&#039;users.index&#039;)&lt;/p&gt;
───→····&lt;/div&gt;
───→········&lt;div·class=&quot;pf-users-branch&quot;&gt;
───→············&lt;ul·class=&quot;pf-users-branch__list&quot;&gt;
───→················@foreach($users·as·$user)
───→········&lt;li&gt;
───→············&lt;img·src=&quot;{{·asset(&#039;img/frontend/icon/branch-arrow.svg&#039;)·}}&quot;·alt=&quot;branch_arrow&quot;&gt;
───→············{{·link_to_route(&quot;frontend.users.user.show&quot;,$users[&quot;name&quot;],$users[&#039;_id&#039;])·}}
───→········&lt;/li&gt;
───→········@endforeach
───→······&lt;/ul&gt;
───→······&lt;div·class=&quot;pf-users-branch__btn&quot;&gt;
───→······@can(&#039;create&#039;,·App\Models\User::class)
───→············{!!·link_to_route(&quot;frontend.users.user.create&quot;,__(&#039;users.create&#039;),[1,2,3],[&#039;class&#039;·=&gt;·&#039;btn&#039;])·!!}
───→············@endcan
───→········&lt;/div&gt;
───→··&lt;/div&gt;
───→····&lt;/div&gt;
───→&lt;/section&gt;
───→@endsection
───→@section(&#039;footer&#039;)
───→@stop
───→BLADE;
</pre></td><td>Formatted Output (<a href="./recipes/cases/Blade/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;BLADE&#039;
───→@extends(&#039;frontend.layouts.app&#039;)
───→@section(&#039;title&#039;)·foo
───→@endsection
───→@section(&#039;content&#039;)
───→····&lt;section·id=&quot;content&quot;&gt;
───→········&lt;div·class=&quot;container·mod-users-pd-h&quot;&gt;
───→············&lt;div·class=&quot;pf-user-header&quot;&gt;
───→················&lt;div&gt;&lt;/div&gt;
───→················&lt;p&gt;@lang(&#039;users.index&#039;)&lt;/p&gt;
───→············&lt;/div&gt;
───→············&lt;div·class=&quot;pf-users-branch&quot;&gt;
───→················&lt;ul·class=&quot;pf-users-branch__list&quot;&gt;
───→····················@foreach·($users·as·$user)
───→························&lt;li&gt;
───→····························&lt;img·src=&quot;{{·asset(&#039;img/frontend/icon/branch-arrow.svg&#039;)·}}&quot;·alt=&quot;branch_arrow&quot;&gt;
───→····························{{·link_to_route(&#039;frontend.users.user.show&#039;,·$users[&#039;name&#039;],·$users[&#039;_id&#039;])·}}
───→························&lt;/li&gt;
───→····················@endforeach
───→················&lt;/ul&gt;
───→················&lt;div·class=&quot;pf-users-branch__btn&quot;&gt;
───→····················@can(&#039;create&#039;,·App\Models\User::class)
───→························{!!·link_to_route(&#039;frontend.users.user.create&#039;,·__(&#039;users.create&#039;),·[1,·2,·3],·[&#039;class&#039;·=&gt;·&#039;btn&#039;])·!!}
───→····················@endcan
───→················&lt;/div&gt;
───→············&lt;/div&gt;
───→········&lt;/div&gt;
───→····&lt;/section&gt;
───→@endsection
───→@section(&#039;footer&#039;)
───→@stop
───→BLADE;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### CSS

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.css.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;CSS&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser css&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/CSS/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;CSS&#039;
───→body{margin:0;padding:0;background:#f5f5f5}
───→.container·{·display:flex;flex-direction:column;·align-items:center}
───→h1{color:red;font-size:24px·}
───→button{background:blue;color:white;border:none;padding:10px··20px}
───→button:hover{background·:·darkblue}
───→.item{margin-top:10px}
───→.item.active{color:green;font-weight:bold·}
───→CSS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/CSS/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;CSS&#039;
───→body·{
───→··margin:·0;
───→··padding:·0;
───→··background:·#f5f5f5;
───→}
───→.container·{
───→··display:·flex;
───→··flex-direction:·column;
───→··align-items:·center;
───→}
───→h1·{
───→··color:·red;
───→··font-size:·24px;
───→}
───→button·{
───→··background:·blue;
───→··color:·white;
───→··border:·none;
───→··padding:·10px·20px;
───→}
───→button:hover·{
───→··background:·darkblue;
───→}
───→.item·{
───→··margin-top:·10px;
───→}
───→.item.active·{
───→··color:·green;
───→··font-weight:·bold;
───→}
───→CSS;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.css.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;CSS&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser css&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/CSS/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;CSS&#039;
───→body{margin:0;padding:0;background:#f5f5f5}
───→.container·{·display:flex;flex-direction:column;·align-items:center}
───→h1{color:red;font-size:24px·}
───→button{background:blue;color:white;border:none;padding:10px··20px}
───→button:hover{background·:·darkblue}
───→.item{margin-top:10px}
───→.item.active{color:green;font-weight:bold·}
───→CSS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/CSS/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;CSS&#039;
───→body·{
───→··margin:·0;
───→··padding:·0;
───→··background:·#f5f5f5;
───→}
───→.container·{
───→··display:·flex;
───→··flex-direction:·column;
───→··align-items:·center;
───→}
───→h1·{
───→··color:·red;
───→··font-size:·24px;
───→}
───→button·{
───→··background:·blue;
───→··color:·white;
───→··border:·none;
───→··padding:·10px·20px;
───→}
───→button:hover·{
───→··background:·darkblue;
───→}
───→.item·{
───→··margin-top:·10px;
───→}
───→.item.active·{
───→··color:·green;
───→··font-weight:·bold;
───→}
───→CSS;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### GraphQL

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.gql.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;GQL&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser graphql&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/GraphQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;GQL&#039;
───→query···GetUsers($limit:Int,$active:Boolean){
───→users(limit:$limit,active:$active){
───→id·name···email
───→posts·{·id·title···comments{·id·content·}·}
───→}}
───→
───→···
───→·
───→mutation···AddUser($name:String!,$email:String!){
───→createUser(name:$name,email:$email){
───→id···name·email}}
───→GQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/GraphQL/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;GQL&#039;
───→query·GetUsers($limit:·Int,·$active:·Boolean)·{
───→··users(limit:·$limit,·active:·$active)·{
───→····id
───→····name
───→····email
───→····posts·{
───→······id
───→······title
───→······comments·{
───→········id
───→········content
───→······}
───→····}
───→··}
───→}
───→
───→mutation·AddUser($name:·String!,·$email:·String!)·{
───→··createUser(name:·$name,·email:·$email)·{
───→····id
───→····name
───→····email
───→··}
───→}
───→GQL;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.gql.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;GQL&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser graphql&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/GraphQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;GQL&#039;
───→query···GetUsers($limit:Int,$active:Boolean){
───→users(limit:$limit,active:$active){
───→id·name···email
───→posts·{·id·title···comments{·id·content·}·}
───→}}
───→
───→···
───→·
───→mutation···AddUser($name:String!,$email:String!){
───→createUser(name:$name,email:$email){
───→id···name·email}}
───→GQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/GraphQL/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;GQL&#039;
───→query·GetUsers($limit:·Int,·$active:·Boolean)·{
───→··users(limit:·$limit,·active:·$active)·{
───→····id
───→····name
───→····email
───→····posts·{
───→······id
───→······title
───→······comments·{
───→········id
───→········content
───→······}
───→····}
───→··}
───→}
───→
───→mutation·AddUser($name:·String!,·$email:·String!)·{
───→··createUser(name:·$name,·email:·$email)·{
───→····id
───→····name
───→····email
───→··}
───→}
───→GQL;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### HTML

<table><tr><td><code>php-dom</code></td>
<td>
<details>
<summary>custom</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/custom/php-dom/config.html.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\AbstractStringFormatter;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\CodecInterface;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\PlainStringCodec;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\NormalizerInterface;
<br>
class NativeHtmlFormatter extends AbstractStringFormatter
{
&nbsp;&nbsp;&nbsp;&nbsp;public function __construct(?CodecInterface $interpolationCodec = null, ?NormalizerInterface $lineEndingNormalizer = null)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;parent::__construct(self::class . &#039; (PHP &#039; . PHP_VERSION . &#039;)&#039;, $interpolationCodec, $lineEndingNormalizer);
&nbsp;&nbsp;&nbsp;&nbsp;}
<br>
&nbsp;&nbsp;&nbsp;&nbsp;protected function formatContent(string $original): string
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;try {
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;libxml_use_internal_errors(true);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom = new DOMDocument();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom-&gt;preserveWhiteSpace = false;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom-&gt;formatOutput = true;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom-&gt;loadHTML($original);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return substr((string)$dom-&gt;saveHTML(), 0, -1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} finally {
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;libxml_use_internal_errors(false);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
}
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;HTML&#039; =&gt; new NativeHtmlFormatter (
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;interpolationCodec: new PlainStringCodec(),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/HTML/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;HTML&#039;
───→&lt;!doctype·htMl&gt;
───→&lt;html·LANG=&quot;en&quot;&gt;&lt;head&gt;&lt;title&gt;Hello
───→world!
───→
───→&lt;/title&gt;&lt;/head&gt;
───→
───→&lt;body&gt;
───→───→&lt;h1·class·=·&quot;h1&quot;·id=headline&gt;·A·headline·&lt;/h1&gt;
───→───→&lt;MAIN&gt;
───→··········the·main·content
───→··········&lt;a
───→········href=&quot;#&quot;&gt;
───→········Home
───→&lt;/a&gt;
───→····&lt;/MAIN&gt;····
───→&lt;/body&gt;&lt;/html&gt;
───→HTML;
</pre></td><td>Formatted Output (<a href="./recipes/cases/HTML/output.ext-dom.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;HTML&#039;
───→&lt;!DOCTYPE·htMl&gt;
───→&lt;html·lang=&quot;en&quot;&gt;
───→&lt;head&gt;&lt;title&gt;Hello
───→world!
───→
───→&lt;/title&gt;&lt;/head&gt;
───→
───→&lt;body&gt;
───→───→&lt;h1·class=&quot;h1&quot;·id=&quot;headline&quot;&gt;·A·headline·&lt;/h1&gt;
───→───→&lt;main&gt;
───→··········the·main·content
───→··········&lt;a·href=&quot;#&quot;&gt;
───→········Home
───→&lt;/a&gt;
───→····&lt;/main&gt;····
───→&lt;/body&gt;
───→&lt;/html&gt;
───→HTML;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>
<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.html.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;HTML&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser html&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/HTML/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;HTML&#039;
───→&lt;!doctype·htMl&gt;
───→&lt;html·LANG=&quot;en&quot;&gt;&lt;head&gt;&lt;title&gt;Hello
───→world!
───→
───→&lt;/title&gt;&lt;/head&gt;
───→
───→&lt;body&gt;
───→───→&lt;h1·class·=·&quot;h1&quot;·id=headline&gt;·A·headline·&lt;/h1&gt;
───→───→&lt;MAIN&gt;
───→··········the·main·content
───→··········&lt;a
───→········href=&quot;#&quot;&gt;
───→········Home
───→&lt;/a&gt;
───→····&lt;/MAIN&gt;····
───→&lt;/body&gt;&lt;/html&gt;
───→HTML;
</pre></td><td>Formatted Output (<a href="./recipes/cases/HTML/output.prettier.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;HTML&#039;
───→&lt;!doctype·html&gt;
───→&lt;html·lang=&quot;en&quot;&gt;
───→··&lt;head&gt;
───→····&lt;title&gt;Hello·world!&lt;/title&gt;
───→··&lt;/head&gt;
───→
───→··&lt;body&gt;
───→····&lt;h1·class=&quot;h1&quot;·id=&quot;headline&quot;&gt;A·headline&lt;/h1&gt;
───→····&lt;main&gt;
───→······the·main·content
───→······&lt;a·href=&quot;#&quot;&gt;·Home·&lt;/a&gt;
───→····&lt;/main&gt;
───→··&lt;/body&gt;
───→&lt;/html&gt;
───→HTML;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.html.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;HTML&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser html&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/HTML/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;HTML&#039;
───→&lt;!doctype·htMl&gt;
───→&lt;html·LANG=&quot;en&quot;&gt;&lt;head&gt;&lt;title&gt;Hello
───→world!
───→
───→&lt;/title&gt;&lt;/head&gt;
───→
───→&lt;body&gt;
───→───→&lt;h1·class·=·&quot;h1&quot;·id=headline&gt;·A·headline·&lt;/h1&gt;
───→───→&lt;MAIN&gt;
───→··········the·main·content
───→··········&lt;a
───→········href=&quot;#&quot;&gt;
───→········Home
───→&lt;/a&gt;
───→····&lt;/MAIN&gt;····
───→&lt;/body&gt;&lt;/html&gt;
───→HTML;
</pre></td><td>Formatted Output (<a href="./recipes/cases/HTML/output.prettier.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;HTML&#039;
───→&lt;!doctype·html&gt;
───→&lt;html·lang=&quot;en&quot;&gt;
───→··&lt;head&gt;
───→····&lt;title&gt;Hello·world!&lt;/title&gt;
───→··&lt;/head&gt;
───→
───→··&lt;body&gt;
───→····&lt;h1·class=&quot;h1&quot;·id=&quot;headline&quot;&gt;A·headline&lt;/h1&gt;
───→····&lt;main&gt;
───→······the·main·content
───→······&lt;a·href=&quot;#&quot;&gt;·Home·&lt;/a&gt;
───→····&lt;/main&gt;
───→··&lt;/body&gt;
───→&lt;/html&gt;
───→HTML;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### JSON

<table><tr><td><code>jq</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/jq/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSON&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;jq --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;jq --indent 4 --monochrome-output .&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSON/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{···&quot;user&quot;:{·&quot;id&quot;:1,
───→&quot;name&quot;··:·&quot;Alice&quot;,
───→····&quot;roles&quot;:[·&quot;admin&quot;,&quot;editor&quot;·,··&quot;user&quot;·],
───→&quot;active&quot;:true,
───→········&quot;profile&quot;·:{
───→───→&quot;email&quot;:&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:&quot;123·Main·St&quot;,
───→&quot;city&quot;:&quot;Somewhere&quot;··,····&quot;zip&quot;:12345},
───→───→───→&quot;phones&quot;:[
───→&quot;123-456-7890&quot;,
───→····&quot;987-654-3210&quot;····]
───→····}
───→},
───→····&quot;logs&quot;·:·[·{·&quot;event&quot;:&quot;login&quot;,&quot;success&quot;:true},
───→{····&quot;event&quot;:&quot;update_profile&quot;,
───→&quot;success&quot;:false··}·]
───→}
───→JSON;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSON/output.jq.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{
───→····&quot;user&quot;:·{
───→········&quot;id&quot;:·1,
───→········&quot;name&quot;:·&quot;Alice&quot;,
───→········&quot;roles&quot;:·[
───→············&quot;admin&quot;,
───→············&quot;editor&quot;,
───→············&quot;user&quot;
───→········],
───→········&quot;active&quot;:·true,
───→········&quot;profile&quot;:·{
───→············&quot;email&quot;:·&quot;alice@example.com&quot;,
───→············&quot;address&quot;:·{
───→················&quot;street&quot;:·&quot;123·Main·St&quot;,
───→················&quot;city&quot;:·&quot;Somewhere&quot;,
───→················&quot;zip&quot;:·12345
───→············},
───→············&quot;phones&quot;:·[
───→················&quot;123-456-7890&quot;,
───→················&quot;987-654-3210&quot;
───→············]
───→········}
───→····},
───→····&quot;logs&quot;:·[
───→········{
───→············&quot;event&quot;:·&quot;login&quot;,
───→············&quot;success&quot;:·true
───→········},
───→········{
───→············&quot;event&quot;:·&quot;update_profile&quot;,
───→············&quot;success&quot;:·false
───→········}
───→····]
───→}
───→JSON;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>docker</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/docker/jq/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\DockerPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSON&#039; =&gt; new DockerPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;image: &#039;ghcr.io/jqlang/jq&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;command: [&#039;--indent&#039;, &#039;4&#039;, &#039;--monochrome-output&#039;, &#039;.&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pullMode: &#039;missing&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSON/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{···&quot;user&quot;:{·&quot;id&quot;:1,
───→&quot;name&quot;··:·&quot;Alice&quot;,
───→····&quot;roles&quot;:[·&quot;admin&quot;,&quot;editor&quot;·,··&quot;user&quot;·],
───→&quot;active&quot;:true,
───→········&quot;profile&quot;·:{
───→───→&quot;email&quot;:&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:&quot;123·Main·St&quot;,
───→&quot;city&quot;:&quot;Somewhere&quot;··,····&quot;zip&quot;:12345},
───→───→───→&quot;phones&quot;:[
───→&quot;123-456-7890&quot;,
───→····&quot;987-654-3210&quot;····]
───→····}
───→},
───→····&quot;logs&quot;·:·[·{·&quot;event&quot;:&quot;login&quot;,&quot;success&quot;:true},
───→{····&quot;event&quot;:&quot;update_profile&quot;,
───→&quot;success&quot;:false··}·]
───→}
───→JSON;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSON/output.jq.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{
───→····&quot;user&quot;:·{
───→········&quot;id&quot;:·1,
───→········&quot;name&quot;:·&quot;Alice&quot;,
───→········&quot;roles&quot;:·[
───→············&quot;admin&quot;,
───→············&quot;editor&quot;,
───→············&quot;user&quot;
───→········],
───→········&quot;active&quot;:·true,
───→········&quot;profile&quot;:·{
───→············&quot;email&quot;:·&quot;alice@example.com&quot;,
───→············&quot;address&quot;:·{
───→················&quot;street&quot;:·&quot;123·Main·St&quot;,
───→················&quot;city&quot;:·&quot;Somewhere&quot;,
───→················&quot;zip&quot;:·12345
───→············},
───→············&quot;phones&quot;:·[
───→················&quot;123-456-7890&quot;,
───→················&quot;987-654-3210&quot;
───→············]
───→········}
───→····},
───→····&quot;logs&quot;:·[
───→········{
───→············&quot;event&quot;:·&quot;login&quot;,
───→············&quot;success&quot;:·true
───→········},
───→········{
───→············&quot;event&quot;:·&quot;update_profile&quot;,
───→············&quot;success&quot;:·false
───→········}
───→····]
───→}
───→JSON;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/jq/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSON&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;jq --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;jq --indent 4 --monochrome-output .&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSON/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{···&quot;user&quot;:{·&quot;id&quot;:1,
───→&quot;name&quot;··:·&quot;Alice&quot;,
───→····&quot;roles&quot;:[·&quot;admin&quot;,&quot;editor&quot;·,··&quot;user&quot;·],
───→&quot;active&quot;:true,
───→········&quot;profile&quot;·:{
───→───→&quot;email&quot;:&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:&quot;123·Main·St&quot;,
───→&quot;city&quot;:&quot;Somewhere&quot;··,····&quot;zip&quot;:12345},
───→───→───→&quot;phones&quot;:[
───→&quot;123-456-7890&quot;,
───→····&quot;987-654-3210&quot;····]
───→····}
───→},
───→····&quot;logs&quot;·:·[·{·&quot;event&quot;:&quot;login&quot;,&quot;success&quot;:true},
───→{····&quot;event&quot;:&quot;update_profile&quot;,
───→&quot;success&quot;:false··}·]
───→}
───→JSON;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSON/output.jq.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{
───→····&quot;user&quot;:·{
───→········&quot;id&quot;:·1,
───→········&quot;name&quot;:·&quot;Alice&quot;,
───→········&quot;roles&quot;:·[
───→············&quot;admin&quot;,
───→············&quot;editor&quot;,
───→············&quot;user&quot;
───→········],
───→········&quot;active&quot;:·true,
───→········&quot;profile&quot;:·{
───→············&quot;email&quot;:·&quot;alice@example.com&quot;,
───→············&quot;address&quot;:·{
───→················&quot;street&quot;:·&quot;123·Main·St&quot;,
───→················&quot;city&quot;:·&quot;Somewhere&quot;,
───→················&quot;zip&quot;:·12345
───→············},
───→············&quot;phones&quot;:·[
───→················&quot;123-456-7890&quot;,
───→················&quot;987-654-3210&quot;
───→············]
───→········}
───→····},
───→····&quot;logs&quot;:·[
───→········{
───→············&quot;event&quot;:·&quot;login&quot;,
───→············&quot;success&quot;:·true
───→········},
───→········{
───→············&quot;event&quot;:·&quot;update_profile&quot;,
───→············&quot;success&quot;:·false
───→········}
───→····]
───→}
───→JSON;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>
<table><tr><td><code>php-json</code></td>
<td>
<details>
<summary>custom</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/custom/php-json/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\AbstractStringFormatter;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\CodecInterface;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\PlainStringCodec;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\NormalizerInterface;
<br>
class NativeJsonFormatter extends AbstractStringFormatter
{
&nbsp;&nbsp;&nbsp;&nbsp;public function __construct(?CodecInterface $interpolationCodec = null, ?NormalizerInterface $lineEndingNormalizer = null)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;parent::__construct(self::class . &#039; (PHP &#039; . PHP_VERSION . &#039;)&#039;, $interpolationCodec, $lineEndingNormalizer);
&nbsp;&nbsp;&nbsp;&nbsp;}
<br>
&nbsp;&nbsp;&nbsp;&nbsp;protected function formatContent(string $original): string
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return json_encode(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;json_decode($original, false, 512, JSON_THROW_ON_ERROR),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;);
&nbsp;&nbsp;&nbsp;&nbsp;}
}
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSON&#039; =&gt; new NativeJsonFormatter(interpolationCodec: new PlainStringCodec()),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSON/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{···&quot;user&quot;:{·&quot;id&quot;:1,
───→&quot;name&quot;··:·&quot;Alice&quot;,
───→····&quot;roles&quot;:[·&quot;admin&quot;,&quot;editor&quot;·,··&quot;user&quot;·],
───→&quot;active&quot;:true,
───→········&quot;profile&quot;·:{
───→───→&quot;email&quot;:&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:&quot;123·Main·St&quot;,
───→&quot;city&quot;:&quot;Somewhere&quot;··,····&quot;zip&quot;:12345},
───→───→───→&quot;phones&quot;:[
───→&quot;123-456-7890&quot;,
───→····&quot;987-654-3210&quot;····]
───→····}
───→},
───→····&quot;logs&quot;·:·[·{·&quot;event&quot;:&quot;login&quot;,&quot;success&quot;:true},
───→{····&quot;event&quot;:&quot;update_profile&quot;,
───→&quot;success&quot;:false··}·]
───→}
───→JSON;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSON/output.ext-json.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{
───→····&quot;user&quot;:·{
───→········&quot;id&quot;:·1,
───→········&quot;name&quot;:·&quot;Alice&quot;,
───→········&quot;roles&quot;:·[
───→············&quot;admin&quot;,
───→············&quot;editor&quot;,
───→············&quot;user&quot;
───→········],
───→········&quot;active&quot;:·true,
───→········&quot;profile&quot;:·{
───→············&quot;email&quot;:·&quot;alice@example.com&quot;,
───→············&quot;address&quot;:·{
───→················&quot;street&quot;:·&quot;123·Main·St&quot;,
───→················&quot;city&quot;:·&quot;Somewhere&quot;,
───→················&quot;zip&quot;:·12345
───→············},
───→············&quot;phones&quot;:·[
───→················&quot;123-456-7890&quot;,
───→················&quot;987-654-3210&quot;
───→············]
───→········}
───→····},
───→····&quot;logs&quot;:·[
───→········{
───→············&quot;event&quot;:·&quot;login&quot;,
───→············&quot;success&quot;:·true
───→········},
───→········{
───→············&quot;event&quot;:·&quot;update_profile&quot;,
───→············&quot;success&quot;:·false
───→········}
───→····]
───→}
───→JSON;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>
<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.json.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSON&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser json&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSON/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{···&quot;user&quot;:{·&quot;id&quot;:1,
───→&quot;name&quot;··:·&quot;Alice&quot;,
───→····&quot;roles&quot;:[·&quot;admin&quot;,&quot;editor&quot;·,··&quot;user&quot;·],
───→&quot;active&quot;:true,
───→········&quot;profile&quot;·:{
───→───→&quot;email&quot;:&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:&quot;123·Main·St&quot;,
───→&quot;city&quot;:&quot;Somewhere&quot;··,····&quot;zip&quot;:12345},
───→───→───→&quot;phones&quot;:[
───→&quot;123-456-7890&quot;,
───→····&quot;987-654-3210&quot;····]
───→····}
───→},
───→····&quot;logs&quot;·:·[·{·&quot;event&quot;:&quot;login&quot;,&quot;success&quot;:true},
───→{····&quot;event&quot;:&quot;update_profile&quot;,
───→&quot;success&quot;:false··}·]
───→}
───→JSON;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSON/output.prettier.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{
───→··&quot;user&quot;:·{
───→····&quot;id&quot;:·1,
───→····&quot;name&quot;:·&quot;Alice&quot;,
───→····&quot;roles&quot;:·[&quot;admin&quot;,·&quot;editor&quot;,·&quot;user&quot;],
───→····&quot;active&quot;:·true,
───→····&quot;profile&quot;:·{
───→······&quot;email&quot;:·&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:·&quot;123·Main·St&quot;,·&quot;city&quot;:·&quot;Somewhere&quot;,·&quot;zip&quot;:·12345·},
───→······&quot;phones&quot;:·[&quot;123-456-7890&quot;,·&quot;987-654-3210&quot;]
───→····}
───→··},
───→··&quot;logs&quot;:·[
───→····{·&quot;event&quot;:·&quot;login&quot;,·&quot;success&quot;:·true·},
───→····{·&quot;event&quot;:·&quot;update_profile&quot;,·&quot;success&quot;:·false·}
───→··]
───→}
───→JSON;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.json.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSON&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser json&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSON/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{···&quot;user&quot;:{·&quot;id&quot;:1,
───→&quot;name&quot;··:·&quot;Alice&quot;,
───→····&quot;roles&quot;:[·&quot;admin&quot;,&quot;editor&quot;·,··&quot;user&quot;·],
───→&quot;active&quot;:true,
───→········&quot;profile&quot;·:{
───→───→&quot;email&quot;:&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:&quot;123·Main·St&quot;,
───→&quot;city&quot;:&quot;Somewhere&quot;··,····&quot;zip&quot;:12345},
───→───→───→&quot;phones&quot;:[
───→&quot;123-456-7890&quot;,
───→····&quot;987-654-3210&quot;····]
───→····}
───→},
───→····&quot;logs&quot;·:·[·{·&quot;event&quot;:&quot;login&quot;,&quot;success&quot;:true},
───→{····&quot;event&quot;:&quot;update_profile&quot;,
───→&quot;success&quot;:false··}·]
───→}
───→JSON;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSON/output.prettier.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSON&#039;
───→{
───→··&quot;user&quot;:·{
───→····&quot;id&quot;:·1,
───→····&quot;name&quot;:·&quot;Alice&quot;,
───→····&quot;roles&quot;:·[&quot;admin&quot;,·&quot;editor&quot;,·&quot;user&quot;],
───→····&quot;active&quot;:·true,
───→····&quot;profile&quot;:·{
───→······&quot;email&quot;:·&quot;alice@example.com&quot;,
───→······&quot;address&quot;:·{·&quot;street&quot;:·&quot;123·Main·St&quot;,·&quot;city&quot;:·&quot;Somewhere&quot;,·&quot;zip&quot;:·12345·},
───→······&quot;phones&quot;:·[&quot;123-456-7890&quot;,·&quot;987-654-3210&quot;]
───→····}
───→··},
───→··&quot;logs&quot;:·[
───→····{·&quot;event&quot;:·&quot;login&quot;,·&quot;success&quot;:·true·},
───→····{·&quot;event&quot;:·&quot;update_profile&quot;,·&quot;success&quot;:·false·}
───→··]
───→}
───→JSON;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### JSX

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.jsx.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSX&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser babel&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSX/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSX&#039;
───→import·React,{useState,useEffect}·from·&quot;react&quot;
───→
───→export·default·function···App(·){
───→const·[count,setCount]=useState(0)
───→const·[items,setItems]=useState([1,2,3])
───→
───→useEffect(()=&gt;{console.log(&quot;mounted&quot;)
───→return·()=&gt;{console.log(&quot;unmounted&quot;)}},[])
───→
───→function·handleClick(·){
───→setCount(count+1)
───→setItems(items.concat(count))
───→}
───→
───→return·&lt;div·style={{padding:20,backgroundColor:&quot;#f0f0f0&quot;}}&gt;
───→&lt;h1&gt;···Messy···JSX·Example·&lt;/h1&gt;
───→&lt;button·onClick={()=&gt;{handleClick()}}&gt;·Click·me·&lt;/button&gt;
───→
───→&lt;ul&gt;
───→{items.map((item,i)=&gt;{
───→if(item%2===0){
───→return·&lt;li·key={i}·style={{color:&quot;blue&quot;}}&gt;·even:·{item}·&lt;/li&gt;}
───→else{
───→return·&lt;li·key={i}·style={{color:&quot;red&quot;}}&gt;odd:{item}&lt;/li&gt;}})}
───→&lt;/ul&gt;
───→
───→{count&gt;5?&lt;p&gt;High·count!&lt;/p&gt;:&lt;p&gt;Low·count&lt;/p&gt;}
───→
───→&lt;div&gt;
───→{[...Array(3)].map((_,i)=&gt;{return·&lt;span·key={i}&gt;·{i}·&lt;/span&gt;})}
───→&lt;/div&gt;
───→
───→&lt;input·type=&quot;text&quot;·onChange={(e)=&gt;{console.log(e.target.value)}}··/&gt;
───→
───→&lt;/div&gt;}
───→JSX;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSX/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSX&#039;
───→import·React,·{·useState,·useEffect·}·from·&quot;react&quot;;
───→
───→export·default·function·App()·{
───→··const·[count,·setCount]·=·useState(0);
───→··const·[items,·setItems]·=·useState([1,·2,·3]);
───→
───→··useEffect(()·=&gt;·{
───→····console.log(&quot;mounted&quot;);
───→····return·()·=&gt;·{
───→······console.log(&quot;unmounted&quot;);
───→····};
───→··},·[]);
───→
───→··function·handleClick()·{
───→····setCount(count·+·1);
───→····setItems(items.concat(count));
───→··}
───→
───→··return·(
───→····&lt;div·style={{·padding:·20,·backgroundColor:·&quot;#f0f0f0&quot;·}}&gt;
───→······&lt;h1&gt;·Messy·JSX·Example·&lt;/h1&gt;
───→······&lt;button
───→········onClick={()·=&gt;·{
───→··········handleClick();
───→········}}
───→······&gt;
───→········{&quot;·&quot;}
───→········Click·me{&quot;·&quot;}
───→······&lt;/button&gt;
───→
───→······&lt;ul&gt;
───→········{items.map((item,·i)·=&gt;·{
───→··········if·(item·%·2·===·0)·{
───→············return·(
───→··············&lt;li·key={i}·style={{·color:·&quot;blue&quot;·}}&gt;
───→················{&quot;·&quot;}
───→················even:·{item}{&quot;·&quot;}
───→··············&lt;/li&gt;
───→············);
───→··········}·else·{
───→············return·(
───→··············&lt;li·key={i}·style={{·color:·&quot;red&quot;·}}&gt;
───→················odd:{item}
───→··············&lt;/li&gt;
───→············);
───→··········}
───→········})}
───→······&lt;/ul&gt;
───→
───→······{count·&gt;·5·?·&lt;p&gt;High·count!&lt;/p&gt;·:·&lt;p&gt;Low·count&lt;/p&gt;}
───→
───→······&lt;div&gt;
───→········{[...Array(3)].map((_,·i)·=&gt;·{
───→··········return·&lt;span·key={i}&gt;·{i}·&lt;/span&gt;;
───→········})}
───→······&lt;/div&gt;
───→
───→······&lt;input
───→········type=&quot;text&quot;
───→········onChange={(e)·=&gt;·{
───→··········console.log(e.target.value);
───→········}}
───→······/&gt;
───→····&lt;/div&gt;
───→··);
───→}
───→JSX;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.jsx.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JSX&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser babel&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JSX/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSX&#039;
───→import·React,{useState,useEffect}·from·&quot;react&quot;
───→
───→export·default·function···App(·){
───→const·[count,setCount]=useState(0)
───→const·[items,setItems]=useState([1,2,3])
───→
───→useEffect(()=&gt;{console.log(&quot;mounted&quot;)
───→return·()=&gt;{console.log(&quot;unmounted&quot;)}},[])
───→
───→function·handleClick(·){
───→setCount(count+1)
───→setItems(items.concat(count))
───→}
───→
───→return·&lt;div·style={{padding:20,backgroundColor:&quot;#f0f0f0&quot;}}&gt;
───→&lt;h1&gt;···Messy···JSX·Example·&lt;/h1&gt;
───→&lt;button·onClick={()=&gt;{handleClick()}}&gt;·Click·me·&lt;/button&gt;
───→
───→&lt;ul&gt;
───→{items.map((item,i)=&gt;{
───→if(item%2===0){
───→return·&lt;li·key={i}·style={{color:&quot;blue&quot;}}&gt;·even:·{item}·&lt;/li&gt;}
───→else{
───→return·&lt;li·key={i}·style={{color:&quot;red&quot;}}&gt;odd:{item}&lt;/li&gt;}})}
───→&lt;/ul&gt;
───→
───→{count&gt;5?&lt;p&gt;High·count!&lt;/p&gt;:&lt;p&gt;Low·count&lt;/p&gt;}
───→
───→&lt;div&gt;
───→{[...Array(3)].map((_,i)=&gt;{return·&lt;span·key={i}&gt;·{i}·&lt;/span&gt;})}
───→&lt;/div&gt;
───→
───→&lt;input·type=&quot;text&quot;·onChange={(e)=&gt;{console.log(e.target.value)}}··/&gt;
───→
───→&lt;/div&gt;}
───→JSX;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JSX/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JSX&#039;
───→import·React,·{·useState,·useEffect·}·from·&quot;react&quot;;
───→
───→export·default·function·App()·{
───→··const·[count,·setCount]·=·useState(0);
───→··const·[items,·setItems]·=·useState([1,·2,·3]);
───→
───→··useEffect(()·=&gt;·{
───→····console.log(&quot;mounted&quot;);
───→····return·()·=&gt;·{
───→······console.log(&quot;unmounted&quot;);
───→····};
───→··},·[]);
───→
───→··function·handleClick()·{
───→····setCount(count·+·1);
───→····setItems(items.concat(count));
───→··}
───→
───→··return·(
───→····&lt;div·style={{·padding:·20,·backgroundColor:·&quot;#f0f0f0&quot;·}}&gt;
───→······&lt;h1&gt;·Messy·JSX·Example·&lt;/h1&gt;
───→······&lt;button
───→········onClick={()·=&gt;·{
───→··········handleClick();
───→········}}
───→······&gt;
───→········{&quot;·&quot;}
───→········Click·me{&quot;·&quot;}
───→······&lt;/button&gt;
───→
───→······&lt;ul&gt;
───→········{items.map((item,·i)·=&gt;·{
───→··········if·(item·%·2·===·0)·{
───→············return·(
───→··············&lt;li·key={i}·style={{·color:·&quot;blue&quot;·}}&gt;
───→················{&quot;·&quot;}
───→················even:·{item}{&quot;·&quot;}
───→··············&lt;/li&gt;
───→············);
───→··········}·else·{
───→············return·(
───→··············&lt;li·key={i}·style={{·color:·&quot;red&quot;·}}&gt;
───→················odd:{item}
───→··············&lt;/li&gt;
───→············);
───→··········}
───→········})}
───→······&lt;/ul&gt;
───→
───→······{count·&gt;·5·?·&lt;p&gt;High·count!&lt;/p&gt;·:·&lt;p&gt;Low·count&lt;/p&gt;}
───→
───→······&lt;div&gt;
───→········{[...Array(3)].map((_,·i)·=&gt;·{
───→··········return·&lt;span·key={i}&gt;·{i}·&lt;/span&gt;;
───→········})}
───→······&lt;/div&gt;
───→
───→······&lt;input
───→········type=&quot;text&quot;
───→········onChange={(e)·=&gt;·{
───→··········console.log(e.target.value);
───→········}}
───→······/&gt;
───→····&lt;/div&gt;
───→··);
───→}
───→JSX;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### JavaScript

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.js.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JS&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser babel&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JavaScript/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JS&#039;
───→function··calcStuff(a,b){let·result=0
───→if(a&gt;10){
───→for(let·i=0;i&lt;b;i++){·result+=i*·a
───→if(i%2===0){console.log(&quot;even&quot;,i)}·else
───→{·console.log(·&quot;odd&quot;,·i·)}}}
───→else{
───→let·obj={x:1,y:2,z:[1,2,3].map(n=&gt;{return·n*a})}
───→Object.keys(obj).forEach((k)=&gt;{
───→if(typeof·obj[k]===&quot;number&quot;){result+=obj[k]}
───→else·if(Array.isArray(obj[k])){
───→obj[k].forEach(v=&gt;{result+=v})}})}
───→
───→let·weird·=·[1,2,3,4].reduce((acc,cur)=&gt;{
───→if(cur&gt;2){return·acc+cur}else{return·acc}},0)
───→
───→return·{···result:result·,·extra:weird}
───→}
───→
───→
───→
───→const·data·=[·{name:&quot;Alice&quot;,age:25},{name:&quot;Bob&quot;,age:30}·,{name:&quot;Charlie&quot;,age:35}]
───→data.forEach((person)=&gt;{
───→if(person.age&gt;28){·console.log(·person.name.toUpperCase()·)}
───→else{console.log(person.name.toLowerCase())}})
───→JS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JavaScript/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JS&#039;
───→function·calcStuff(a,·b)·{
───→··let·result·=·0;
───→··if·(a·&gt;·10)·{
───→····for·(let·i·=·0;·i·&lt;·b;·i++)·{
───→······result·+=·i·*·a;
───→······if·(i·%·2·===·0)·{
───→········console.log(&quot;even&quot;,·i);
───→······}·else·{
───→········console.log(&quot;odd&quot;,·i);
───→······}
───→····}
───→··}·else·{
───→····let·obj·=·{
───→······x:·1,
───→······y:·2,
───→······z:·[1,·2,·3].map((n)·=&gt;·{
───→········return·n·*·a;
───→······}),
───→····};
───→····Object.keys(obj).forEach((k)·=&gt;·{
───→······if·(typeof·obj[k]·===·&quot;number&quot;)·{
───→········result·+=·obj[k];
───→······}·else·if·(Array.isArray(obj[k]))·{
───→········obj[k].forEach((v)·=&gt;·{
───→··········result·+=·v;
───→········});
───→······}
───→····});
───→··}
───→
───→··let·weird·=·[1,·2,·3,·4].reduce((acc,·cur)·=&gt;·{
───→····if·(cur·&gt;·2)·{
───→······return·acc·+·cur;
───→····}·else·{
───→······return·acc;
───→····}
───→··},·0);
───→
───→··return·{·result:·result,·extra:·weird·};
───→}
───→
───→const·data·=·[
───→··{·name:·&quot;Alice&quot;,·age:·25·},
───→··{·name:·&quot;Bob&quot;,·age:·30·},
───→··{·name:·&quot;Charlie&quot;,·age:·35·},
───→];
───→data.forEach((person)·=&gt;·{
───→··if·(person.age·&gt;·28)·{
───→····console.log(person.name.toUpperCase());
───→··}·else·{
───→····console.log(person.name.toLowerCase());
───→··}
───→});
───→JS;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.js.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;JS&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser babel&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/JavaScript/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JS&#039;
───→function··calcStuff(a,b){let·result=0
───→if(a&gt;10){
───→for(let·i=0;i&lt;b;i++){·result+=i*·a
───→if(i%2===0){console.log(&quot;even&quot;,i)}·else
───→{·console.log(·&quot;odd&quot;,·i·)}}}
───→else{
───→let·obj={x:1,y:2,z:[1,2,3].map(n=&gt;{return·n*a})}
───→Object.keys(obj).forEach((k)=&gt;{
───→if(typeof·obj[k]===&quot;number&quot;){result+=obj[k]}
───→else·if(Array.isArray(obj[k])){
───→obj[k].forEach(v=&gt;{result+=v})}})}
───→
───→let·weird·=·[1,2,3,4].reduce((acc,cur)=&gt;{
───→if(cur&gt;2){return·acc+cur}else{return·acc}},0)
───→
───→return·{···result:result·,·extra:weird}
───→}
───→
───→
───→
───→const·data·=[·{name:&quot;Alice&quot;,age:25},{name:&quot;Bob&quot;,age:30}·,{name:&quot;Charlie&quot;,age:35}]
───→data.forEach((person)=&gt;{
───→if(person.age&gt;28){·console.log(·person.name.toUpperCase()·)}
───→else{console.log(person.name.toLowerCase())}})
───→JS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/JavaScript/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;JS&#039;
───→function·calcStuff(a,·b)·{
───→··let·result·=·0;
───→··if·(a·&gt;·10)·{
───→····for·(let·i·=·0;·i·&lt;·b;·i++)·{
───→······result·+=·i·*·a;
───→······if·(i·%·2·===·0)·{
───→········console.log(&quot;even&quot;,·i);
───→······}·else·{
───→········console.log(&quot;odd&quot;,·i);
───→······}
───→····}
───→··}·else·{
───→····let·obj·=·{
───→······x:·1,
───→······y:·2,
───→······z:·[1,·2,·3].map((n)·=&gt;·{
───→········return·n·*·a;
───→······}),
───→····};
───→····Object.keys(obj).forEach((k)·=&gt;·{
───→······if·(typeof·obj[k]·===·&quot;number&quot;)·{
───→········result·+=·obj[k];
───→······}·else·if·(Array.isArray(obj[k]))·{
───→········obj[k].forEach((v)·=&gt;·{
───→··········result·+=·v;
───→········});
───→······}
───→····});
───→··}
───→
───→··let·weird·=·[1,·2,·3,·4].reduce((acc,·cur)·=&gt;·{
───→····if·(cur·&gt;·2)·{
───→······return·acc·+·cur;
───→····}·else·{
───→······return·acc;
───→····}
───→··},·0);
───→
───→··return·{·result:·result,·extra:·weird·};
───→}
───→
───→const·data·=·[
───→··{·name:·&quot;Alice&quot;,·age:·25·},
───→··{·name:·&quot;Bob&quot;,·age:·30·},
───→··{·name:·&quot;Charlie&quot;,·age:·35·},
───→];
───→data.forEach((person)·=&gt;·{
───→··if·(person.age·&gt;·28)·{
───→····console.log(person.name.toUpperCase());
───→··}·else·{
───→····console.log(person.name.toLowerCase());
───→··}
───→});
───→JS;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### Markdown

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.md.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;MD&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser markdown&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/Markdown/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;MD&#039;
───→#···Messy·Markdown
───→
───→Some·text·with··**bold**and·*italic·*·mixed·badly.
───→
───→-·item·1
───→·-·item·2
───→-····item·3
───→
───→1.·first
───→2.second
───→···3.···third
───→
───→&gt;·quote
───→&gt;&gt;·nested·quote
───→
───→`inline·code`and·more·text···with·weird·spacing
───→|col1|·col2·|
───→|---|---|
───→|a|b|
───→|·c·|··d|
───→MD;
</pre></td><td>Formatted Output (<a href="./recipes/cases/Markdown/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;MD&#039;
───→#·Messy·Markdown
───→
───→Some·text·with·**bold**and·_italic·_·mixed·badly.
───→
───→-·item·1
───→-·item·2
───→-·item·3
───→
───→1.·first
───→···2.second·3.·third
───→
───→&gt;·quote
───→&gt;
───→&gt;·&gt;·nested·quote
───→
───→`inline·code`and·more·text·with·weird·spacing
───→|col1|·col2·|
───→|---|---|
───→|a|b|
───→|·c·|·d|
───→MD;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.md.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;MD&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser markdown&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/Markdown/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;MD&#039;
───→#···Messy·Markdown
───→
───→Some·text·with··**bold**and·*italic·*·mixed·badly.
───→
───→-·item·1
───→·-·item·2
───→-····item·3
───→
───→1.·first
───→2.second
───→···3.···third
───→
───→&gt;·quote
───→&gt;&gt;·nested·quote
───→
───→`inline·code`and·more·text···with·weird·spacing
───→|col1|·col2·|
───→|---|---|
───→|a|b|
───→|·c·|··d|
───→MD;
</pre></td><td>Formatted Output (<a href="./recipes/cases/Markdown/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;MD&#039;
───→#·Messy·Markdown
───→
───→Some·text·with·**bold**and·_italic·_·mixed·badly.
───→
───→-·item·1
───→-·item·2
───→-·item·3
───→
───→1.·first
───→···2.second·3.·third
───→
───→&gt;·quote
───→&gt;
───→&gt;·&gt;·nested·quote
───→
───→`inline·code`and·more·text·with·weird·spacing
───→|col1|·col2·|
───→|---|---|
───→|a|b|
───→|·c·|·d|
───→MD;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### SCSS

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.scss.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SCSS&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser scss&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SCSS/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SCSS&#039;
───→$primary·:blue;$padding:10px
───→
───→.container{·display:flex;
───→.item{color:$primary;
───→&amp;.active{·font-weight:bold}
───→button{padding:$padding;background:$primary;
───→&amp;:hover{background:darken($primary,10%)}·}·}·}
───→
───→h1·{·color·:·red}
───→SCSS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SCSS/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SCSS&#039;
───→$primary:·blue;
───→$padding:·10px·.container·{
───→··display:·flex;
───→··.item·{
───→····color:·$primary;
───→····&amp;.active·{
───→······font-weight:·bold;
───→····}
───→····button·{
───→······padding:·$padding;
───→······background:·$primary;
───→······&amp;:hover·{
───→········background:·darken($primary,·10%);
───→······}
───→····}
───→··}
───→}
───→
───→h1·{
───→··color:·red;
───→}
───→SCSS;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.scss.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SCSS&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser scss&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SCSS/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SCSS&#039;
───→$primary·:blue;$padding:10px
───→
───→.container{·display:flex;
───→.item{color:$primary;
───→&amp;.active{·font-weight:bold}
───→button{padding:$padding;background:$primary;
───→&amp;:hover{background:darken($primary,10%)}·}·}·}
───→
───→h1·{·color·:·red}
───→SCSS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SCSS/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SCSS&#039;
───→$primary:·blue;
───→$padding:·10px·.container·{
───→··display:·flex;
───→··.item·{
───→····color:·$primary;
───→····&amp;.active·{
───→······font-weight:·bold;
───→····}
───→····button·{
───→······padding:·$padding;
───→······background:·$primary;
───→······&amp;:hover·{
───→········background:·darken($primary,·10%);
───→······}
───→····}
───→··}
───→}
───→
───→h1·{
───→··color:·red;
───→}
───→SCSS;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### SQL

<table><tr><td><code>sql-formatter</code></td>
<td>
<details>
<summary>docker</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/docker/sql-formatter/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\DockerPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new DockerPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;image: &#039;backplane/sql-formatter&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pullMode: &#039;missing&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sql-formatter.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT
───→··id,
───→··name,
───→··email
───→FROM
───→··users
───→where
───→··is_active·=·1
───→··and·last_login·&gt;·&#039;2026-01-01&#039;
───→ORDER·by
───→··last_login·desc;
───→
───→insert·into
───→··orders·(user_id,·product_id,·quantity,·total_price)
───→values
───→··(1,·2,·5,·99.95),
───→··(2,·3,·1,·19.99),
───→··(3,·1,·2,·39.98);
───→
───→UPDATE·products
───→set
───→··stock·=·stock·-1
───→where
───→··id·=·2;
───→
───→DELETE·FROM·sessions
───→WHERE
───→··created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→--·messy·join··
───→select
───→··u.id,
───→··u.name,
───→··o.id,
───→··o.total_price
───→from
───→··users·u
───→··inner·join·orders·o·on·u.id·=·o.user_id
───→where
───→··o.total_price·&gt;·50
───→order·by
───→··o.total_price·desc;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>
<table><tr><td><code>sqlfluff</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/sqlfluff/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;sqlfluff --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;sqlfluff format --dialect ansi -&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sqlfluff.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT
───→····id,
───→····name,
───→····email
───→FROM·users
───→WHERE·is_active·=·1·AND·last_login·&gt;·&#039;2026-01-01&#039;
───→ORDER·BY·last_login·DESC;
───→
───→INSERT·INTO·orders·(user_id,·product_id,·quantity,·total_price)
───→VALUES·(1,·2,·5,·99.95),·(2,·3,·1,·19.99),·(3,·1,·2,·39.98);
───→
───→UPDATE·products·SET·stock·=·stock·-·1
───→WHERE·id·=·2;
───→
───→DELETE·FROM·sessions
───→WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→--·messy·join··
───→SELECT
───→····u.id,
───→····u.name,
───→····o.id,
───→····o.total_price
───→FROM·users·u·INNER·JOIN·orders·o
───→····ON·u.id·=·o.user_id
───→WHERE·o.total_price·&gt;·50
───→ORDER·BY·o.total_price·DESC;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>docker</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/docker/sqlfluff/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\DockerPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new DockerPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;image: &#039;sqlfluff/sqlfluff&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;command: [&#039;format&#039;, &#039;--dialect&#039;, &#039;ansi&#039;, &#039;-&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pullMode: &#039;missing&#039;,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sqlfluff.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT
───→····id,
───→····name,
───→····email
───→FROM·users
───→WHERE·is_active·=·1·AND·last_login·&gt;·&#039;2026-01-01&#039;
───→ORDER·BY·last_login·DESC;
───→
───→INSERT·INTO·orders·(user_id,·product_id,·quantity,·total_price)
───→VALUES·(1,·2,·5,·99.95),·(2,·3,·1,·19.99),·(3,·1,·2,·39.98);
───→
───→UPDATE·products·SET·stock·=·stock·-·1
───→WHERE·id·=·2;
───→
───→DELETE·FROM·sessions
───→WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→--·messy·join··
───→SELECT
───→····u.id,
───→····u.name,
───→····o.id,
───→····o.total_price
───→FROM·users·u·INNER·JOIN·orders·o
───→····ON·u.id·=·o.user_id
───→WHERE·o.total_price·&gt;·50
───→ORDER·BY·o.total_price·DESC;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/sqlfluff/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;sqlfluff --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;sqlfluff format --dialect ansi -&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sqlfluff.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT
───→····id,
───→····name,
───→····email
───→FROM·users
───→WHERE·is_active·=·1·AND·last_login·&gt;·&#039;2026-01-01&#039;
───→ORDER·BY·last_login·DESC;
───→
───→INSERT·INTO·orders·(user_id,·product_id,·quantity,·total_price)
───→VALUES·(1,·2,·5,·99.95),·(2,·3,·1,·19.99),·(3,·1,·2,·39.98);
───→
───→UPDATE·products·SET·stock·=·stock·-·1
───→WHERE·id·=·2;
───→
───→DELETE·FROM·sessions
───→WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→--·messy·join··
───→SELECT
───→····u.id,
───→····u.name,
───→····o.id,
───→····o.total_price
───→FROM·users·u·INNER·JOIN·orders·o
───→····ON·u.id·=·o.user_id
───→WHERE·o.total_price·&gt;·50
───→ORDER·BY·o.total_price·DESC;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>
<table><tr><td><code>sqlfmt</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/sqlfmt/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;sqlfmt --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;sqlfmt -&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sqlfmt.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→select·id,·name,·email
───→from·users
───→where·is_active·=·1·and·last_login·&gt;·&#039;2026-01-01&#039;
───→order·by·last_login·desc
───→;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→delete·from·sessions
───→where·created_at·&lt;·&#039;2026-01-01&#039;
───→;
───→
───→--·messy·join··
───→select·u.id,·u.name,·o.id,·o.total_price
───→from·users·u
───→inner·join·orders·o·on·u.id·=·o.user_id
───→where·o.total_price·&gt;·50
───→order·by·o.total_price·desc
───→;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/sqlfmt/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;sqlfmt --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;sqlfmt --upper --spaces 4&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sqlfmt.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→select·id,·name,·email
───→from·users
───→where·is_active·=·1·and·last_login·&gt;·&#039;2026-01-01&#039;
───→order·by·last_login·desc
───→;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→delete·from·sessions
───→where·created_at·&lt;·&#039;2026-01-01&#039;
───→;
───→
───→--·messy·join··
───→select·u.id,·u.name,·o.id,·o.total_price
───→from·users·u
───→inner·join·orders·o·on·u.id·=·o.user_id
───→where·o.total_price·&gt;·50
───→order·by·o.total_price·desc
───→;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>
<table><tr><td><code>sqlformat</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/sqlformat/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;sqlformat --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;sqlformat -k upper -s -r -&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sqlformat.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,
───→·······name,
───→·······email
───→FROM·users
───→WHERE·is_active·=·1
───→··AND·last_login·&gt;·&#039;2026-01-01&#039;
───→ORDER·BY·last_login·DESC;
───→
───→
───→INSERT·INTO·orders(user_id,·product_id,·quantity,·total_price)
───→VALUES(1,·2,·5,·99.95),
───→······(2,3,1,19.99)·,
───→······(3,1,2,39.98);
───→
───→
───→UPDATE·products
───→SET·stock·=·stock·-1
───→WHERE·id·=·2;
───→
───→
───→DELETE
───→FROM·sessions
───→WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→--·messy·join
───→
───→SELECT·u.id,
───→·······u.name,
───→·······o.id,
───→·······o.total_price
───→FROM·users·u
───→INNER·JOIN·orders·o·ON·u.id·=·o.user_id
───→WHERE·o.total_price·&gt;·50
───→ORDER·BY·o.total_price·DESC;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/sqlformat/config.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;SQL&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;sqlformat --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;sqlformat -k upper -s -r -&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/SQL/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,name,email··FROM·users·where···is_active=1·and·last_login·&gt;&#039;2026-01-01&#039;·ORDER·by·last_login·desc;
───→
───→insert·into·orders(user_id,product_id,·quantity,total_price)
───→values(··1,·2·,··5·,··99.95),(2,3,1,19.99)·,·(3,1,2,39.98);
───→
───→UPDATE·products·set·stock=·stock·-1·where·id=2;
───→
───→DELETE··FROM·sessions·WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→··--·messy·join··
───→select·u.id,u.name,o.id,o.total_price·from·users·u·inner·join·orders·o
───→on·u.id=o.user_id·where·o.total_price&gt;50·order·by·o.total_price·desc;
───→SQL;
</pre></td><td>Formatted Output (<a href="./recipes/cases/SQL/output.sqlformat.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;SQL&#039;
───→SELECT·id,
───→·······name,
───→·······email
───→FROM·users
───→WHERE·is_active·=·1
───→··AND·last_login·&gt;·&#039;2026-01-01&#039;
───→ORDER·BY·last_login·DESC;
───→
───→
───→INSERT·INTO·orders(user_id,·product_id,·quantity,·total_price)
───→VALUES(1,·2,·5,·99.95),
───→······(2,3,1,19.99)·,
───→······(3,1,2,39.98);
───→
───→
───→UPDATE·products
───→SET·stock·=·stock·-1
───→WHERE·id·=·2;
───→
───→
───→DELETE
───→FROM·sessions
───→WHERE·created_at·&lt;·&#039;2026-01-01&#039;;
───→
───→--·messy·join
───→
───→SELECT·u.id,
───→·······u.name,
───→·······o.id,
───→·······o.total_price
───→FROM·users·u
───→INNER·JOIN·orders·o·ON·u.id·=·o.user_id
───→WHERE·o.total_price·&gt;·50
───→ORDER·BY·o.total_price·DESC;
───→SQL;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### TypeScript

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.ts.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;TS&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser typescript&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/TypeScript/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;TS&#039;
───→type·User·={id:number,name:string,active?:boolean}
───→
───→function·processUsers(users:User[]·){
───→let·result·:number=0
───→let·names:string[]=[]
───→
───→users.forEach((u)=&gt;{
───→if(u.active===true){
───→result+=u.id
───→names.push(u.name.toUpperCase())
───→}else{
───→if(u.active===false){
───→names.push(u.name.toLowerCase())}
───→else{
───→names.push(&quot;unknown&quot;)}}})
───→
───→const·extra·=·users.map((u)=&gt;{
───→return·{·...u·,·label·:·u.name·+·&quot;-&quot;·+·u.id·}})
───→
───→return·{result:result,names:names,extra:extra}
───→}
───→TS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/TypeScript/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;TS&#039;
───→type·User·=·{·id:·number;·name:·string;·active?:·boolean·};
───→
───→function·processUsers(users:·User[])·{
───→··let·result:·number·=·0;
───→··let·names:·string[]·=·[];
───→
───→··users.forEach((u)·=&gt;·{
───→····if·(u.active·===·true)·{
───→······result·+=·u.id;
───→······names.push(u.name.toUpperCase());
───→····}·else·{
───→······if·(u.active·===·false)·{
───→········names.push(u.name.toLowerCase());
───→······}·else·{
───→········names.push(&quot;unknown&quot;);
───→······}
───→····}
───→··});
───→
───→··const·extra·=·users.map((u)·=&gt;·{
───→····return·{·...u,·label:·u.name·+·&quot;-&quot;·+·u.id·};
───→··});
───→
───→··return·{·result:·result,·names:·names,·extra:·extra·};
───→}
───→TS;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.ts.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;TS&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser typescript&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/TypeScript/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;TS&#039;
───→type·User·={id:number,name:string,active?:boolean}
───→
───→function·processUsers(users:User[]·){
───→let·result·:number=0
───→let·names:string[]=[]
───→
───→users.forEach((u)=&gt;{
───→if(u.active===true){
───→result+=u.id
───→names.push(u.name.toUpperCase())
───→}else{
───→if(u.active===false){
───→names.push(u.name.toLowerCase())}
───→else{
───→names.push(&quot;unknown&quot;)}}})
───→
───→const·extra·=·users.map((u)=&gt;{
───→return·{·...u·,·label·:·u.name·+·&quot;-&quot;·+·u.id·}})
───→
───→return·{result:result,names:names,extra:extra}
───→}
───→TS;
</pre></td><td>Formatted Output (<a href="./recipes/cases/TypeScript/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;TS&#039;
───→type·User·=·{·id:·number;·name:·string;·active?:·boolean·};
───→
───→function·processUsers(users:·User[])·{
───→··let·result:·number·=·0;
───→··let·names:·string[]·=·[];
───→
───→··users.forEach((u)·=&gt;·{
───→····if·(u.active·===·true)·{
───→······result·+=·u.id;
───→······names.push(u.name.toUpperCase());
───→····}·else·{
───→······if·(u.active·===·false)·{
───→········names.push(u.name.toLowerCase());
───→······}·else·{
───→········names.push(&quot;unknown&quot;);
───→······}
───→····}
───→··});
───→
───→··const·extra·=·users.map((u)·=&gt;·{
───→····return·{·...u,·label:·u.name·+·&quot;-&quot;·+·u.id·};
───→··});
───→
───→··return·{·result:·result,·names:·names,·extra:·extra·};
───→}
───→TS;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### Vue

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.vue.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;VUE&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser vue&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/Vue/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;VUE&#039;
───→&lt;template&gt;&lt;div&gt;
───→&lt;h1&gt;·Messy·Vue·&lt;/h1&gt;
───→&lt;button·@click=&quot;inc&quot;&gt;·click·&lt;/button&gt;
───→&lt;p·v-if=&quot;count&gt;3&quot;&gt;·high·&lt;/p&gt;&lt;p·v-else&gt;low&lt;/p&gt;
───→&lt;ul&gt;&lt;li·v-for=&quot;(i,idx)·in·list&quot;·:key=&quot;idx&quot;&gt;
───→&lt;span·v-if=&quot;i%2===0&quot;&gt;even·{{i}}&lt;/span&gt;&lt;span·v-else&gt;·odd·{{·i·}}·&lt;/span&gt;
───→&lt;/li&gt;&lt;/ul&gt;
───→&lt;/div&gt;&lt;/template&gt;
───→
───→&lt;script&gt;
───→export·default{
───→name:&quot;App&quot;,
───→data(·){return{count:0,list:[1,2,3]}},
───→methods:{inc(·){
───→this.count++
───→this.list.push(this.count)
───→}}
───→}
───→&lt;/script&gt;
───→
───→&lt;style&gt;
───→h1{color:red}
───→button·{margin-top:10px}
───→&lt;/style&gt;
───→VUE;
</pre></td><td>Formatted Output (<a href="./recipes/cases/Vue/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;VUE&#039;
───→&lt;template&gt;
───→··&lt;div&gt;
───→····&lt;h1&gt;Messy·Vue&lt;/h1&gt;
───→····&lt;button·@click=&quot;inc&quot;&gt;click&lt;/button&gt;
───→····&lt;p·v-if=&quot;count·&gt;·3&quot;&gt;high&lt;/p&gt;
───→····&lt;p·v-else&gt;low&lt;/p&gt;
───→····&lt;ul&gt;
───→······&lt;li·v-for=&quot;(i,·idx)·in·list&quot;·:key=&quot;idx&quot;&gt;
───→········&lt;span·v-if=&quot;i·%·2·===·0&quot;&gt;even·{{·i·}}&lt;/span
───→········&gt;&lt;span·v-else&gt;·odd·{{·i·}}·&lt;/span&gt;
───→······&lt;/li&gt;
───→····&lt;/ul&gt;
───→··&lt;/div&gt;
───→&lt;/template&gt;
───→
───→&lt;script&gt;
───→export·default·{
───→··name:·&quot;App&quot;,
───→··data()·{
───→····return·{·count:·0,·list:·[1,·2,·3]·};
───→··},
───→··methods:·{
───→····inc()·{
───→······this.count++;
───→······this.list.push(this.count);
───→····},
───→··},
───→};
───→&lt;/script&gt;
───→
───→&lt;style&gt;
───→h1·{
───→··color:·red;
───→}
───→button·{
───→··margin-top:·10px;
───→}
───→&lt;/style&gt;
───→VUE;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.vue.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;VUE&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser vue&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/Vue/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;VUE&#039;
───→&lt;template&gt;&lt;div&gt;
───→&lt;h1&gt;·Messy·Vue·&lt;/h1&gt;
───→&lt;button·@click=&quot;inc&quot;&gt;·click·&lt;/button&gt;
───→&lt;p·v-if=&quot;count&gt;3&quot;&gt;·high·&lt;/p&gt;&lt;p·v-else&gt;low&lt;/p&gt;
───→&lt;ul&gt;&lt;li·v-for=&quot;(i,idx)·in·list&quot;·:key=&quot;idx&quot;&gt;
───→&lt;span·v-if=&quot;i%2===0&quot;&gt;even·{{i}}&lt;/span&gt;&lt;span·v-else&gt;·odd·{{·i·}}·&lt;/span&gt;
───→&lt;/li&gt;&lt;/ul&gt;
───→&lt;/div&gt;&lt;/template&gt;
───→
───→&lt;script&gt;
───→export·default{
───→name:&quot;App&quot;,
───→data(·){return{count:0,list:[1,2,3]}},
───→methods:{inc(·){
───→this.count++
───→this.list.push(this.count)
───→}}
───→}
───→&lt;/script&gt;
───→
───→&lt;style&gt;
───→h1{color:red}
───→button·{margin-top:10px}
───→&lt;/style&gt;
───→VUE;
</pre></td><td>Formatted Output (<a href="./recipes/cases/Vue/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;VUE&#039;
───→&lt;template&gt;
───→··&lt;div&gt;
───→····&lt;h1&gt;Messy·Vue&lt;/h1&gt;
───→····&lt;button·@click=&quot;inc&quot;&gt;click&lt;/button&gt;
───→····&lt;p·v-if=&quot;count·&gt;·3&quot;&gt;high&lt;/p&gt;
───→····&lt;p·v-else&gt;low&lt;/p&gt;
───→····&lt;ul&gt;
───→······&lt;li·v-for=&quot;(i,·idx)·in·list&quot;·:key=&quot;idx&quot;&gt;
───→········&lt;span·v-if=&quot;i·%·2·===·0&quot;&gt;even·{{·i·}}&lt;/span
───→········&gt;&lt;span·v-else&gt;·odd·{{·i·}}·&lt;/span&gt;
───→······&lt;/li&gt;
───→····&lt;/ul&gt;
───→··&lt;/div&gt;
───→&lt;/template&gt;
───→
───→&lt;script&gt;
───→export·default·{
───→··name:·&quot;App&quot;,
───→··data()·{
───→····return·{·count:·0,·list:·[1,·2,·3]·};
───→··},
───→··methods:·{
───→····inc()·{
───→······this.count++;
───→······this.list.push(this.count);
───→····},
───→··},
───→};
───→&lt;/script&gt;
───→
───→&lt;style&gt;
───→h1·{
───→··color:·red;
───→}
───→button·{
───→··margin-top:·10px;
───→}
───→&lt;/style&gt;
───→VUE;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### XML

<table><tr><td><code>php-dom</code></td>
<td>
<details>
<summary>custom</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/custom/php-dom/config.xml.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\AbstractCodecFormatter;
use uuf6429\PhpCsFixerBlockstring\Formatter\AbstractStringFormatter;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\CodecInterface;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\PlainStringCodec;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\NormalizerInterface;
<br>
class NativeXmlFormatter extends AbstractStringFormatter
{
&nbsp;&nbsp;&nbsp;&nbsp;public function __construct(?CodecInterface $interpolationCodec = null, ?NormalizerInterface $lineEndingNormalizer = null)
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;parent::__construct(self::class . &#039; (PHP &#039; . PHP_VERSION . &#039;)&#039;, $interpolationCodec, $lineEndingNormalizer);
&nbsp;&nbsp;&nbsp;&nbsp;}
<br>
&nbsp;&nbsp;&nbsp;&nbsp;protected function formatContent(string $original): string
&nbsp;&nbsp;&nbsp;&nbsp;{
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;try {
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;libxml_use_internal_errors(true);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom = new DOMDocument();
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom-&gt;preserveWhiteSpace = false;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom-&gt;formatOutput = true;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$dom-&gt;loadXML($original);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return substr((string)$dom-&gt;saveXML(), 0, -1);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} finally {
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;libxml_use_internal_errors(false);
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
&nbsp;&nbsp;&nbsp;&nbsp;}
}
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;XML&#039; =&gt; new NativeHtmlFormatter (
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;interpolationCodec: new PlainStringCodec(),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/XML/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;XML&#039;
───→&lt;?xml·version=&quot;1.0&quot;?&gt;&lt;catalog&gt;&lt;book·id=&quot;bk101&quot;
───→···genre=&quot;Fantasy&quot;&gt;&lt;author&gt;Garcia,·Debra&lt;/author&gt;&lt;title&gt;·The···Lost···Realm·&lt;/title&gt;
───→&lt;price·currency=&quot;USD&quot;&gt;··19.99&lt;/price&gt;&lt;publish_date&gt;2023-07-01&lt;/publish_date&gt;
───→&lt;description&gt;·An·epic·tale·of·magic,·dragons,and·destiny.·&lt;/description&gt;&lt;/book&gt;
───→&lt;book·id=&quot;bk102&quot;·genre=&quot;SciFi&quot;···&gt;&lt;author&gt;··Smith,·John&lt;/author&gt;
───→&lt;title&gt;Stars·Beyond&lt;/title&gt;&lt;price·currency=&quot;EUR&quot;&gt;15.5&lt;/price&gt;
───→&lt;publish_date&gt;2022-11-15&lt;/publish_date&gt;
───→&lt;description&gt;A·journey·through·space·and···time.&lt;/description&gt;&lt;/book&gt;&lt;book·id=&quot;bk103&quot;
───→genre=&quot;Horror&quot;&gt;&lt;author&gt;King,···Anne&lt;/author&gt;&lt;title&gt;Night·Terrors&lt;/title&gt;
───→&lt;price·currency=&quot;GBP&quot;&gt;12.00&lt;/price&gt;&lt;publish_date&gt;2021-10-31&lt;/publish_date&gt;
───→&lt;description&gt;··Fear·lurks·in·every·shadow.·&lt;/description&gt;&lt;/book&gt;
───→&lt;metadata···created=&quot;2024-01-01&quot;···updated·=&quot;2024-06-01&quot;&gt;
───→&lt;tags&gt;&lt;tag&gt;books&lt;/tag&gt;&lt;tag&gt;fiction&lt;/tag&gt;
───→&lt;tag&gt;···mixed-format·&lt;/tag&gt;&lt;/tags&gt;&lt;/metadata&gt;&lt;/catalog&gt;
───→XML;
</pre></td><td>Formatted Output (<a href="./recipes/cases/XML/output.ext-dom.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;XML&#039;
───→&lt;?xml·version=&quot;1.0&quot;?&gt;
───→&lt;catalog&gt;
───→··&lt;book·id=&quot;bk101&quot;·genre=&quot;Fantasy&quot;&gt;
───→····&lt;author&gt;Garcia,·Debra&lt;/author&gt;
───→····&lt;title&gt;·The···Lost···Realm·&lt;/title&gt;
───→····&lt;price·currency=&quot;USD&quot;&gt;··19.99&lt;/price&gt;
───→····&lt;publish_date&gt;2023-07-01&lt;/publish_date&gt;
───→····&lt;description&gt;·An·epic·tale·of·magic,·dragons,and·destiny.·&lt;/description&gt;
───→··&lt;/book&gt;
───→··&lt;book·id=&quot;bk102&quot;·genre=&quot;SciFi&quot;&gt;
───→····&lt;author&gt;··Smith,·John&lt;/author&gt;
───→····&lt;title&gt;Stars·Beyond&lt;/title&gt;
───→····&lt;price·currency=&quot;EUR&quot;&gt;15.5&lt;/price&gt;
───→····&lt;publish_date&gt;2022-11-15&lt;/publish_date&gt;
───→····&lt;description&gt;A·journey·through·space·and···time.&lt;/description&gt;
───→··&lt;/book&gt;
───→··&lt;book·id=&quot;bk103&quot;·genre=&quot;Horror&quot;&gt;
───→····&lt;author&gt;King,···Anne&lt;/author&gt;
───→····&lt;title&gt;Night·Terrors&lt;/title&gt;
───→····&lt;price·currency=&quot;GBP&quot;&gt;12.00&lt;/price&gt;
───→····&lt;publish_date&gt;2021-10-31&lt;/publish_date&gt;
───→····&lt;description&gt;··Fear·lurks·in·every·shadow.·&lt;/description&gt;
───→··&lt;/book&gt;
───→··&lt;metadata·created=&quot;2024-01-01&quot;·updated=&quot;2024-06-01&quot;&gt;
───→····&lt;tags&gt;
───→······&lt;tag&gt;books&lt;/tag&gt;
───→······&lt;tag&gt;fiction&lt;/tag&gt;
───→······&lt;tag&gt;···mixed-format·&lt;/tag&gt;
───→····&lt;/tags&gt;
───→··&lt;/metadata&gt;
───→&lt;/catalog&gt;
───→XML;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>

### YAML

<table><tr><td><code>prettier</code></td>
<td>
<details>
<summary>cli</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/cli/prettier/config.yaml.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;YAML&#039; =&gt; new CliPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser yaml&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lineEndingNormalizer: new DefaultNormalizer(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeLinesTo: DefaultNormalizer::LF,
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;changeFinalLineTo: DefaultNormalizer::STRIP
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/YAML/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;YAML&#039;
───→name:·Example
───→version·:·&quot;1.0&quot;
───→items:
───→··-·id:·1
───→····name:·Item·One
───→··-·id·:·2
───→····name:··Item·Two
───→settings:·{enabled:true·,threshold:10}
───→
───→users:
───→··-·name:·Alice
───→····roles:·[admin,user]
───→··-··name:·Bob
───→·····roles:·[·user·]
───→
───→nested:
───→·level1:
───→····level2:····value
───→YAML;
</pre></td><td>Formatted Output (<a href="./recipes/cases/YAML/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;YAML&#039;
───→name:·Example
───→version:·&quot;1.0&quot;
───→items:
───→··-·id:·1
───→····name:·Item·One
───→··-·id:·2
───→····name:·Item·Two
───→settings:·{·enabled:true,·threshold:10·}
───→
───→users:
───→··-·name:·Alice
───→····roles:·[admin,·user]
───→··-·name:·Bob
───→····roles:·[user]
───→
───→nested:
───→··level1:
───→····level2:·value
───→YAML;
</pre></td></tr>
</table>
</details>
</td>
<td>
<details>
<summary>wsl</summary>
<table>
<tr><td colspan="2">Configuration (<a href="./recipes/configs/wsl/prettier/config.yaml.php">source</a>):<pre lang="php">&lt;?php declare(strict_types=1);
<br>
use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;
<br>
return (new PhpCsFixer\Config())
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRiskyAllowed(true)
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;registerCustomFixers([new BlockStringFixer()])
&nbsp;&nbsp;&nbsp;&nbsp;-&gt;setRules([
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BlockStringFixer::NAME =&gt; BlockStringFixer::config(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#039;YAML&#039; =&gt; new WslPipeFormatter(
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;versionValueOrCommand: [&#039;cmd&#039; =&gt; &#039;prettier --version&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;formatCommand: [&#039;cmd&#039; =&gt; &#039;prettier --parser yaml&#039;],
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;),
&nbsp;&nbsp;&nbsp;&nbsp;]);
</pre></td></tr>
<tr><td valign="top">Example Input (<a href="./recipes/cases/YAML/input.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;YAML&#039;
───→name:·Example
───→version·:·&quot;1.0&quot;
───→items:
───→··-·id:·1
───→····name:·Item·One
───→··-·id·:·2
───→····name:··Item·Two
───→settings:·{enabled:true·,threshold:10}
───→
───→users:
───→··-·name:·Alice
───→····roles:·[admin,user]
───→··-··name:·Bob
───→·····roles:·[·user·]
───→
───→nested:
───→·level1:
───→····level2:····value
───→YAML;
</pre></td><td>Formatted Output (<a href="./recipes/cases/YAML/output.php">source</a>):<pre lang="php">&lt;?php·declare(strict_types=1);
<br>
echo·&lt;&lt;&lt;&#039;YAML&#039;
───→name:·Example
───→version:·&quot;1.0&quot;
───→items:
───→··-·id:·1
───→····name:·Item·One
───→··-·id:·2
───→····name:·Item·Two
───→settings:·{·enabled:true,·threshold:10·}
───→
───→users:
───→··-·name:·Alice
───→····roles:·[admin,·user]
───→··-·name:·Bob
───→····roles:·[user]
───→
───→nested:
───→··level1:
───→····level2:·value
───→YAML;
</pre></td></tr>
</table>
</details>
</td>
</tr></table>


[PHP-CS-Fixer]: https://github.com/PHP-CS-Fixer/PHP-CS-Fixer

[`uuf6429/php-cs-fixer-blockstring`]: https://github.com/uuf6429/php-cs-fixer-blockstring
