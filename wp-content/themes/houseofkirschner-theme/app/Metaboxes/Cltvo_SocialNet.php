<?php

namespace App\Metaboxes;

use Illuminate\Metabox;

class Cltvo_SocialNet extends Metabox
{
    protected $description_metabox = "Redes Sociales";
    protected $post_type = "page";

    public static $redesConUrl = [
        'facebook'      => 'Facebook',
        'instagram'     => 'Instagram',
    ];

    protected static $redesSinUrl = [
        'mail'          => 'Email:',
        'phone'         => 'Teléfono',
        'whatsapp'      => 'Whatsapp',
    ];


    public static function metaboxDisplayRule()
    {
		return isSpecialPage('contacto');
	}

    public static function setMetaValue($meta)
    {
        $meta = is_array($meta) ? $meta : [];

        foreach (self::$redesSinUrl as $red => $imagen) {
			$meta[$red] = isset($meta[$red]) ? $meta[$red] :  "";
		}

		foreach (self::$redesConUrl as $red => $imagen) {
			$meta[$red] = isset($meta[$red]) ? $meta[$red] : array('label'=> '', 'url'=> '');
            $meta[$red]['label'] = isset($meta[$red]['label']) ? $meta[$red]['label'] :  "";
            $meta[$red]['url'] = isset($meta[$red]['url']) ? $meta[$red]['url'] :  "";
		}

        return $meta;
    }


	/**
	 * Es la funcion que muestra el contenido del metabox
	 * @param object $object en principio es un objeto de WP_post
	 */
    public function CltvoDisplayMetabox( $object )
    { ?>

        <table class="form-table">
            <tr>
                <th>
                    <label for="mail">Email:</label>
                </th>
                <td>
                    <input type="email" placeholder="ejemplo@ejemplo.com" name="<?php echo  $this->meta_key; ?>[mail]" id="mail" value="<?php echo $this->meta_value['mail']; ?>" />
                </td>
            </tr>
            <tr>
                <th>
                    <label for="phone">Teléfono:</label>
                </th>
                <td>
                    <input type="text" placeholder="" id="phone" name="<?php echo  $this->meta_key; ?>[phone]" value="<?php echo $this->meta_value['phone']; ?>">
                </td>
            </tr>
            <tr>
                <th>
                    <label for="whatsapp">Whatsapp:</label>
                </th>
                <td>
                    <input type="text" placeholder="" id="whatsapp" name="<?php echo  $this->meta_key; ?>[whatsapp]" value="<?php echo $this->meta_value['whatsapp']; ?>">
                </td>
            </tr>
            <?php foreach (self::$redesConUrl as $slug => $nombre): ?>
                <tr>
                    <th>
                        <?php echo $nombre; ?>
                    </th>
                    <td>
                        <?php $this->social_network_url($slug); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php }



    /**
     * Imprime los input de las redes sociales
     *
     * Parametros:
     *
     * @param string $slug slug de la red social
     * @param array $meta array con los valores url y label
     */

    private function social_network_url($slug) {
    	 ?>
            <p>
                <label for="<?php echo $this->meta_key."_".$slug; ?>_label" > <?= __("Nombre" ,TRANSDOMAIN) ?>:</label><br>
                <input type="text"
                      placeholder="<?= $slug ?>"
                      name="<?php echo $this->meta_key."[".$slug."][label]"; ?>"
                      id="<?php echo $this->meta_key."_".$slug; ?>_label"
                      value="<?php echo $this->meta_value[$slug]['label']; ?>"
                      class="ancho_100" />
            </p>
    		<p>
    			<label for="<?php echo $this->meta_key."_".$slug; ?>_url" ><?= __("Link" ,TRANSDOMAIN) ?>:</label><br>
    			<input type="url"
                        placeholder="http://"
                        name="<?php echo $this->meta_key."[".$slug."][url]"; ?>"
                        id="<?php echo $this->meta_key."_".$slug; ?>_url"
                        value="<?php echo $this->meta_value[$slug]['url']; ?>"
                        class="ancho_100" />
    		</p>
    	 <?php
    }

}
