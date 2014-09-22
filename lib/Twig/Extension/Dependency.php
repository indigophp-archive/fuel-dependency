<?php

/*
 * This file is part of the Fuel Dependency package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Extension;

use Twig_Extension;

/**
 * Dependency Container Extension for Twig
 *
 * Use DiC functions (with caution) in your templates
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Dependency extends Twig_Extension
{
	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'dependency';
	}

	/**
	 * {@inheritdocs}
	 */
	public function getFunctions()
	{
        return [
            new Twig_SimpleFilter('dic_resolve', 'Indigo\\Fuel\\Dependency\\Container::resolve'),
            new Twig_SimpleFilter('dic_multiton', 'Indigo\\Fuel\\Dependency\\Container::multiton'),
        ];
	}
}
