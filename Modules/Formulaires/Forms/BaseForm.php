<?php
namespace Modules\Formulaires\Forms;

use Kris\LaravelFormBuilder\Form;
use Modules\Formulaires\Entities\Answer;
use Modules\Formulaires\Entities\Choice;
use Modules\Formulaires\Entities\Field;
use Modules\Formulaires\Entities\Formulaire;

class BaseForm extends Form
{
	private $content = null;

	/**
	 * @return mixed|void
	 */
	public function buildForm()
	{
		$formulaire = Formulaire::where('id', $this->getData('id'))->first();

		if ($this->getData('backoffice') == true)
		{
			$champs = $formulaire->fields->where('actif', '1')->where('backoffice', '1')->sortBy('position');
		}
		else
		{
			$champs = $formulaire->fields->where('actif', '1')->sortBy('position');
		}

		if ($this->getData('answer_id') != null )
		{
			$answer = Answer::where('id', $this->getData('answer_id'))->first();
			$this->content = json_decode($answer->content, true);
		}



		foreach ($champs as $key=>$champ)
		{
			switch ($champ->type)
			{
				case 'static' :
					$this->add($champ->name,  $champ->type,
						$this->setOptionsPara($champ)
					);
				break;


				case 'text' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
				break;


				case 'email' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
					break;


				case 'password' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
					break;


				case 'image' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
					break;


				case 'url' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
					break;


				case 'tel' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
					break;


				case 'range' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
					break;


				case 'color' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
					break;


				case 'textarea' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
				break;


				case 'file' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
				break;


				case 'hidden' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsText($champ)
					);
				break;


				case 'number' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsNumber($champ)
					);
				break;


				case 'date' :
					$this->add($champ->name, $champ->type,
						$this->setOptionsDate($champ)
					);
				break;


				case 'radio' :
					$this->add($champ->name, 'choice',
						$this->setOptionsChoice($champ, "radio")
					);
				break;


				case 'checkbox' :
					$this->add($champ->name, 'choice',
						$this->setOptionsChoice($champ, "checkbox")
					);
				break;


				case 'select':
					if ($champ->multiple == "1")
					{
						$options = $this->setOptionsChoice($champ, 'select_multiple');
					}
					else
					{
						$options = $this->setOptionsChoice($champ, 'select');
					}
					$this->add($champ->name, 'choice',  $options );
				break;


				default;
					dd('Erreur');
				break;
			}
		}
		$this->add('formulaire_id', 'hidden', ['value'=>$formulaire->id]);
		$this->add('submit', 'submit', ['label' => 'Envoyer']);
	}


	public function setOptionsText(Field $champ)
	{
		$options = array(
			'label' => $champ->label_fo,
			'attr' => array(),
		);

		if ($champ->label != null) {
			$options['label'] = $champ->label;
		}
		if ($champ->placeholder != null) {
			$options['attr']['placeholder'] = $champ->placeholder;
		}
		if ($champ->class != null) {
			$options['attr']['class'] = $champ->class;
		}
		if ($champ->required != null) {
			$options['attr']['required'] = 'required';
		}
		if (!is_null($this->content[$champ->name]))
		{
			//dd($this->content[$champ->name]);
			$options['value'] = $this->content[$champ->name];
		}
		else
		{
			if ($champ->value != null)
			{
				$options['value'] = $champ->value;
			}
		}
		if ($champ->max != null) {
			$options['attr']['maxlength'] = $champ->max;
		}
		if ($champ->row != null) {
			$options['attr']['row'] = $champ->row;
		}
		if ($champ->col != null) {
			$options['attr']['col'] = $champ->col;
		}

		//dd($options);
		return $options;
	}

	public function setOptionsHidden(Field $champ)
	{
		$options = array(
			'attr' => array(),
		);

		if (!is_null($this->content[$champ->name]))
		{
			//dd($this->content[$champ->name]);
			$options['value'] = $this->content[$champ->name];
		}
		else
		{
			if ($champ->value != null)
			{
				$options['value'] = $champ->value;
			}
		}

		return $options;
	}

	public function setOptionsChoice(Field $champ, $type)
	{
		$options = array(
			'label' => $champ->label_fo,
			'choices' => array(),
			'selected' => array(),
			'expanded'=> false,
			'multiple'=> false,
		);

		if ($champ->label != null) {
			$options['label'] = $champ->label;
		}
		if ($champ->class != null) {
			$options['attr']['class'] = $champ->class;
		}
		if ($champ->required != null) {
			$options['attr']['required'] = 'required';
		}

		$choices = $champ->choices->where('actif',1);

		foreach ($choices as $key => $choice) {
			$options['choices'][$choice->value] = $choice->label;
			if ($choice->selected == "1" && is_null($this->content[$champ->name])) {
				array_push($options['selected'], $choice['value']);
			}
		}
		if (!is_null($this->content[$champ->name]))
		{
			//dd($this->content[$champ->name]);
			if (is_array($this->content[$champ->name]))
			{
				foreach ($this->content[$champ->name] as $key => $value) {
					array_push($options['selected'], $value);
				}
			}
			else
			{
				array_push($options['selected'], $this->content[$champ->name]);
			}
		}

		switch ($type)
		{
			case "radio" :
				$options['expanded'] = true;
				$options['multiple'] = false;
				break;

			case "checkbox" :
				$options['expanded'] = true;
				$options['multiple'] = true;
				break;

			case "select" :
				$options['expanded'] = false;
				$options['multiple'] = false;
				break;

			case "select_multiple" :
				$options['expanded'] = false;
				$options['multiple'] = true;
				break;
		}

		//dd($options);
		return $options;
	}

	public function setOptionsPara(Field $champ)
	{
		$options = array(
			'tag' => $champ->tag,
			'value' => $champ->value,
			'attr' => array(),
		);

		if ($champ->class != null) {
			$options['attr']['class'] = $champ->class;
		}

		return $options;
	}

	public function setOptionsNumber(Field $champ)
	{
		$options = array(
			'label' => $champ->label_fo,
			'attr' => array(),
		);

		if ($champ->placeholder != null) {
			$options['attr']['placeholder'] = $champ->placeholder;
		}
		if ($champ->class != null) {
			$options['attr']['class'] = $champ->class;
		}
		if ($champ->required != null) {
			$options['attr']['required'] = 'required';
		}
		if (!is_null($this->content[$champ->name]))
		{
			//dd($this->content[$champ->name]);
			$options['value'] = $this->content[$champ->name];
		}
		else
		{
			if ($champ->value != null)
			{
				$options['value'] = $champ->value;
			}
		}
		if ($champ->min != null) {
			$options['attr']['min'] = $champ->min;
		}
		if ($champ->max != null) {
			$options['attr']['max'] = $champ->max;
		}
		if ($champ->step != null) {
			$options['attr']['step'] = $champ->step;
		}

		return $options;
	}


	public function setOptionsDate(Field $champ)
	{
		$options = array(
			'label' => $champ->label_fo,
			'attr' => array(),
		);

		if ($champ->placeholder != null) {
			$options['attr']['placeholder'] = $champ->placeholder;
		}
		if ($champ->class != null) {
			$options['attr']['class'] = $champ->class;
		}
		if ($champ->required != null) {
			$options['attr']['required'] = 'required';
		}
		if ($champ->value != null) {
			if (is_null($this->content))
			{
				$options['default_value'] = $champ->value;
			}
			else
			{
				$options['default_value'] = $this->content[$champ->name];
			}
		}

		return $options;
	}

}

