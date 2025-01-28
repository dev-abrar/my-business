<?php

namespace App\Http\Controllers;

use App\Models\WebContent;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class WebContentController extends Controller
{
    function web_content()
    {
        $webcontents = WebContent::where('id', 1)->first();
        return view('pages.dashboard.web_content', compact('webcontents'));
    }

    function web_content_update(Request $request)
    {
        $present = WebContent::find($request->id);

        // Handle the logo update
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($present->logo != null) {
                $oldLogoPath = public_path('upload/logo/' . $present->logo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath); // Delete old logo file
                }
            }

            // Store the new logo
            $img = $request->file('logo');
            $file_name = $present->id . '.' . $img->getClientOriginalExtension();
            $preview_path = public_path('upload/logo/' . $file_name);

            // Resize the image and save it to the specified path
            Image::make($img)->save($preview_path, 80);

            // Update the web content record with the new logo
            $present->update([
                'logo' => $file_name,
            ]);
        }

        // Update the rest of the content
        WebContent::find($request->id)->update([
            'desp' => $request->desp,
            'address' => $request->address,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'charge' => $request->charge,
            'quran_link' => $request->quran_link,
            'bkash' => $request->bkash,
            'nagad' => $request->nagad,
            'rocket' => $request->rocket,
        ]);

        return back()->with('success', 'Content Updated Successfully!');
    }
}
