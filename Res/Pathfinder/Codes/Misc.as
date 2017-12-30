<pre>
<span style="font-weight: bold;color: #000000;">function</span><span style="color: #000000;"> </span><span style="color: #000080;">GenerateArray</span><span style="color: #000000;">(Largeur:uint=</span><span style="color: #0000ff;">64</span><span style="color: #000000;">,Hauteur:uint=</span><span style="color: #0000ff;">64</span><span style="color: #000000;">):</span><span style="color: #800000;">Array</span>
<span style="color: #000000;">{</span><span style="font-style: italic;color: #808080;">//Génere un tableau multidimensionnel.</span>
<span style="color: #000000;">	</span><span style="font-weight: bold;color: #000000;">var</span><span style="color: #000000;"> Tableau:</span><span style="color: #800000;">Array</span><span style="color: #000000;"> = </span><span style="font-weight: bold;color: #000000;">new</span><span style="color: #000000;"> </span><span style="color: #800000;">Array</span><span style="color: #000000;">();</span>
<span style="color: #000000;">	</span><span style="font-weight: bold;color: #000000;">for</span><span style="color: #000000;">(</span><span style="font-weight: bold;color: #000000;">var</span><span style="color: #000000;"> i:uint=</span><span style="color: #0000ff;">0</span><span style="color: #000000;">;i&lt;=Largeur;i++)</span>
<span style="color: #000000;">	{</span>
<span style="color: #000000;">		Tableau[i] = </span><span style="font-weight: bold;color: #000000;">new</span><span style="color: #000000;"> </span><span style="color: #800000;">Array</span><span style="color: #000000;">();</span>
<span style="color: #000000;">		</span><span style="font-weight: bold;color: #000000;">for</span><span style="color: #000000;">(</span><span style="font-weight: bold;color: #000000;">var</span><span style="color: #000000;"> j:uint=</span><span style="color: #0000ff;">0</span><span style="color: #000000;">;j&lt;=Hauteur;j++)</span>
<span style="color: #000000;">		{</span>
<span style="color: #000000;">			Tableau[i][j]= </span><span style="font-weight: bold;color: #000000;">new</span><span style="color: #000000;"> </span><span style="color: #000080;">t_Map</span><span style="color: #000000;">();</span>
<span style="color: #000000;">		}</span>
<span style="color: #000000;">	}</span>
<span style="color: #000000;">	</span><span style="font-weight: bold;color: #000000;">return</span><span style="color: #000000;"> Tableau;</span>
<span style="color: #000000;">}</span>

<span style="font-weight: bold;color: #000000;">function</span><span style="color: #000000;"> </span><span style="color: #000080;">GenerateArrayOfOpenList</span><span style="color: #000000;">(Largeur:uint=</span><span style="color: #0000ff;">64</span><span style="color: #000000;">,Hauteur:uint=</span><span style="color: #0000ff;">64</span><span style="color: #000000;">):</span><span style="color: #800000;">Array</span>
<span style="color: #000000;">{</span><span style="font-style: italic;color: #808080;">//Génere un tableau multidimensionnel.</span>
<span style="color: #000000;">	</span><span style="font-weight: bold;color: #000000;">var</span><span style="color: #000000;"> Tableau:</span><span style="color: #800000;">Array</span><span style="color: #000000;"> = </span><span style="font-weight: bold;color: #000000;">new</span><span style="color: #000000;"> </span><span style="color: #800000;">Array</span><span style="color: #000000;">();</span>
<span style="color: #000000;">	</span><span style="font-weight: bold;color: #000000;">for</span><span style="color: #000000;">(</span><span style="font-weight: bold;color: #000000;">var</span><span style="color: #000000;"> i:uint=</span><span style="color: #0000ff;">0</span><span style="color: #000000;">;i&lt;=Largeur;i++)</span>
<span style="color: #000000;">	{</span>
<span style="color: #000000;">		Tableau[i] = </span><span style="font-weight: bold;color: #000000;">new</span><span style="color: #000000;"> </span><span style="color: #800000;">Array</span><span style="color: #000000;">();</span>
<span style="color: #000000;">		</span><span style="font-weight: bold;color: #000000;">for</span><span style="color: #000000;">(</span><span style="font-weight: bold;color: #000000;">var</span><span style="color: #000000;"> j:uint=</span><span style="color: #0000ff;">0</span><span style="color: #000000;">;j&lt;=Hauteur;j++)</span>
<span style="color: #000000;">		{</span>
<span style="color: #000000;">			Tableau[i][j]= </span><span style="font-weight: bold;color: #000000;">new</span><span style="color: #000000;"> </span><span style="color: #000080;">t_OpenList</span><span style="color: #000000;">(</span><span style="font-weight: bold;color: #000000;">new</span><span style="color: #000000;"> </span><span style="color: #000080;">Point</span><span style="color: #000000;">());</span>
<span style="color: #000000;">		}</span>
<span style="color: #000000;">	}</span>
<span style="color: #000000;">	</span><span style="font-weight: bold;color: #000000;">return</span><span style="color: #000000;"> Tableau;</span>
<span style="color: #000000;">}</span></pre>