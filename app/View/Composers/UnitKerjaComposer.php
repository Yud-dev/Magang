<?php
namespace App\View\Composers;
use App\Models\Unitkerja;
use Illuminate\View\View;
class UnitKerjaComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $unitkerjas = Unitkerja::all();
        $view->with('unitkerjas', $unitkerjas);
    }
}
?>
