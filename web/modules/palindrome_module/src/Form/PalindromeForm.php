<?php

namespace Drupal\palindrome_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class PalindromeForm extends FormBase
{

    public function getFormId()
    {
        return 'palindrome_module_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Adding TailwindCSS classes to the form elements
        $form['string'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Your palindrome string'),
            '#required' => true,
            '#attributes' => [
                'class' => ['w-2/5', 'mt-8', 'px-4', 'py-2', 'border', 'rounded-md', 'focus:outline-none', 'focus:ring', 'focus:border-blue-300'],
                'placeholder' => $this->t('Enter your string'),
            ],
            '#title_display' => 'invisible',
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
            '#attributes' => [
                'class' => ['mt-4', 'w-2/5', 'bg-blue-500', 'text-white', 'py-2', 'rounded-md', 'hover:bg-blue-600', 'focus:outline-none', 'focus:ring', 'focus:ring-blue-300'],
            ],
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $input_string = $form_state->getValue('string');
        $reversed_string = strrev($input_string);

        if ($input_string === $reversed_string) {
            \Drupal::messenger()->addMessage($this->t('The string "@string" is a palindrome!', ['@string' => $input_string]));
        } else {
            \Drupal::messenger()->addMessage($this->t('The string "@string" is not a palindrome.', ['@string' => $input_string]));
        }
    }
}
