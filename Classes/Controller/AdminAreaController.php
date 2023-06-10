<?php
declare(strict_types=1);

namespace ManhattanReview\Tenzing\Controller;

class AdminAreaController
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Example action returns some dummy data
     */
    public function example(): ?string
    {
        // @TODO: use a template engine such as Smarty or Fluid to parse HTML template
        // files and render the output while keeping the "view" (visual appearance)
        // strictly separated from the logic (the "MVC" principle).
        return 'Admin Area';
    }
}
