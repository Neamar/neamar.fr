//Un niveau standard : contient des liens et des noeuds !
package
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.geom.Point;
	import flash.events.MouseEvent;//Interaction utilisateur//souris
	import flash.filters.BitmapFilter;

	import flash.filters.GlowFilter;
	import flash.text.TextField;//Champ de texte. Classe assez vaste, utilisée uniquement pour l'affichage de texte ici. Peut être du texte au format HTML.

	public class Land extends Sprite
	{
		public var All_Noeuds:Array;
		public var All_Liens:Array;
		public var initialAll_Lienslength:int;
		public var Layer:Game;

		public var StartNode:Noeud;
		public var EndNode:Noeud;

		public var ArrierePlan:BackGround;
		public var PremierPlan:Sprite=new Sprite();

		private var Infos:TextField=new TextField();

		private const FlashWidth:int = 640;
		private const FlashHeight:int = 480;


		public function Land(Datas:String,Layer:Game)
		{
// 			var Niv_String:String="140,240|500,240:0,1,320,440|0,1,320,40|0,1,320,240";
// 			var Niv_String:String= "98,370|419,367|266,211|256,49:3,2,261,130|2,0,232,361|2,1,289,330|2,0,182,291|2,1,342,289";
// 			var Niv_String:String= "34,289|174,282|286,181|286,221|280,280|277,325|277,353|415,320|531,279|411,200|607,276:0,1,104,285|1,2,230,231|1,3,230,252|1,4,227,281|1,5,225,303|1,6,225,317|6,7,347,316|5,7,347,302|7,8,473,299|4,8,406,279|3,9,313,211|2,9,313,191|9,8,471,240|8,10,569,277"

			this.ArrierePlan=new BackGround(this);
			this.addChild(ArrierePlan);
			this.setChildIndex(ArrierePlan,0);


			this.Layer=Layer;
			Infos.x=0;
			Infos.y=FlashHeight-15;
			Infos.autoSize = "left";
			Infos.textColor=0xFFFFFF;
			Infos.thickness=3;
			Infos.selectable=false;

			this.addChild(Infos);
			this.addChild(PremierPlan);

			var Niv_String:String=Datas;
			var Composants:Array;
			var Part:Array=Niv_String.split(":");
			var strNoeuds_Array:Array=Part[0].split("|");
			var strArc_Array:Array=Part[1].split("|");
			var Noeuds:Array=new Array();
			var Liens:Array=new Array();
			for each(var Node:String in strNoeuds_Array)
			{
				Composants=Node.split(",");
				Noeuds.push(Composants);
			}
			for each(var Arete:String in strArc_Array)
			{
				Composants=Arete.split(",");
				Liens.push(Composants);
			}

			CreerNiveau(Noeuds,Liens,FlashWidth,FlashHeight);

			this.setChildIndex(ArrierePlan,0);
		}

		public function set Texte(v:String):void
		{
			this.Infos.htmlText=v.toLocaleUpperCase();
		}

		public function StopBackGround():void
		{
			this.ArrierePlan.StopBackGround();
		}
		private function CreerNiveau(Noeuds:Array,Liens:Array,Largeur:int=0,Hauteur:int=0):void
		{
			var Node:Noeud;
			var Arete:Arc;

			All_Noeuds = new Array();
			All_Liens = new Array();
			for each(var Arr_Noeud:Array in Noeuds)
				All_Noeuds.push(new Noeud(this,Arr_Noeud[0],Arr_Noeud[1]));

			StartNode=All_Noeuds[0];
			EndNode=All_Noeuds[All_Noeuds.length-1];
			StartNode.filters=Const.Filtre_Noeuds_Extremes;
			EndNode.filters=Const.Filtre_Noeuds_Extremes;

			for each(var Arr_Lien:Array in Liens)
			{
				Arete=new Arc(this,All_Noeuds[Arr_Lien[0]],All_Noeuds[Arr_Lien[1]],new Point(Arr_Lien[2],Arr_Lien[3]));
				All_Noeuds[Arr_Lien[0]].AjouterLien(Arete);
				All_Noeuds[Arr_Lien[1]].AjouterLien(Arete);
				All_Liens.push(Arete);
			}
			initialAll_Lienslength=All_Liens.length;

			this.graphics.beginFill(0xFFFFFF);
			this.graphics.drawRect(0,0, Largeur, Hauteur);
		}
	}
}