<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Log; // For debugging

class FooterMain extends Component
{
    public $templatePath;

    /**
     * Create a new component instance.
     *
     * @param string|null $templateName
     * @return void
     */
    public function __construct($templateName = 'footermain')
    {
        // Construct the full template path
        $this->templatePath = "frontend.templete.template.templete.templete.templete.themebase.themename.template.templatename.{$templateName}";

        // Debugging: Log the constructed path
        Log::info('FooterMain templatePath: ' . $this->templatePath);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.app', [
            'templatePath' => $this->templatePath,
        ]);
    }
}
