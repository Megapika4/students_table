<?php
	
class View {
		
		/* замена текста в шаблоне (индексы массива - искомое значение, значения массива - значения замены) */
	public function generate($template_file_name, $data){
		$template = file_get_contents("tmpl/".$template_file_name); //шаблон
		$search = array(); //искомые значение в шаблоне
		$replace = array(); //значение замены
			$i=0;
		foreach($data as $key => $val){
			$search[$i] = "%$key%";
			$replace[$i] = $val;
			$i++;
		}
		$text_return = str_replace($search, $replace, $template); //замена значений в шаблоне
		return $text_return;
	}
	
}