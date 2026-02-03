<?php

namespace LarsKlopstra\Envelop\Atomic\Presets;

use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Rule;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

/**
 * Default atomic CSS preset with Tailwind-inspired utilities.
 *
 * Provides comprehensive design tokens and parsing rules for:
 * - Colors (full Tailwind palette with shades)
 * - Typography (sizes, weights, families, line heights, spacing)
 * - Spacing (padding, margin with numeric and fraction scales)
 * - Layout (display, alignment, sizing)
 * - Borders (widths, colors, radius, styles)
 * - Effects (shadows, opacity)
 */
class DefaultPreset implements Preset
{
    /** @return array<Rule> */
    public function getRules(): array
    {
        return [
            ...$this->getBackgroundColorRules(),
            ...$this->getTextUtilitiesRules(),
            ...$this->getFontRules(),
            ...$this->getLineHeightRules(),
            ...$this->getLetterSpacingRules(),
            ...$this->getTextTransformRules(),
            ...$this->getTextDecorationRules(),
            ...$this->getDisplayRules(),
            ...$this->getVerticalAlignRules(),
            ...$this->getOpacityRules(),
            ...$this->getBoxShadowRules(),
            ...$this->getBorderRules(),
            ...$this->getBorderRadiusRules(),
            ...$this->getSizeRules(),
            ...$this->getPaddingRules(),
            ...$this->getMarginRules(),
        ];
    }

    public function getTheme(): Theme
    {
        return new Theme([
            'colors' => [
                // Grays
                'slate' => [
                    '50' => '#f8fafc',
                    '100' => '#f1f5f9',
                    '200' => '#e2e8f0',
                    '300' => '#cbd5e1',
                    '400' => '#94a3b8',
                    '500' => '#64748b',
                    '600' => '#475569',
                    '700' => '#334155',
                    '800' => '#1e293b',
                    '900' => '#0f172a',
                    '950' => '#020617',
                    'DEFAULT' => '#64748b',
                ],
                'gray' => [
                    '50' => '#f9fafb',
                    '100' => '#f3f4f6',
                    '200' => '#e5e7eb',
                    '300' => '#d1d5db',
                    '400' => '#9ca3af',
                    '500' => '#6b7280',
                    '600' => '#4b5563',
                    '700' => '#374151',
                    '800' => '#1f2937',
                    '900' => '#111827',
                    '950' => '#030712',
                    'DEFAULT' => '#6b7280',
                ],
                'zinc' => [
                    '50' => '#fafafa',
                    '100' => '#f4f4f5',
                    '200' => '#e4e4e7',
                    '300' => '#d4d4d8',
                    '400' => '#a1a1aa',
                    '500' => '#71717a',
                    '600' => '#52525b',
                    '700' => '#3f3f46',
                    '800' => '#27272a',
                    '900' => '#18181b',
                    '950' => '#09090b',
                    'DEFAULT' => '#71717a',
                ],
                'neutral' => [
                    '50' => '#fafafa',
                    '100' => '#f5f5f5',
                    '200' => '#e5e5e5',
                    '300' => '#d4d4d4',
                    '400' => '#a3a3a3',
                    '500' => '#737373',
                    '600' => '#525252',
                    '700' => '#404040',
                    '800' => '#262626',
                    '900' => '#171717',
                    '950' => '#0a0a0a',
                    'DEFAULT' => '#737373',
                ],
                'stone' => [
                    '50' => '#fafaf9',
                    '100' => '#f5f5f4',
                    '200' => '#e7e5e4',
                    '300' => '#d6d3d1',
                    '400' => '#a8a29e',
                    '500' => '#78716c',
                    '600' => '#57534e',
                    '700' => '#44403c',
                    '800' => '#292524',
                    '900' => '#1c1917',
                    '950' => '#0c0a09',
                    'DEFAULT' => '#78716c',
                ],
                // Colors
                'red' => [
                    '50' => '#fef2f2',
                    '100' => '#fee2e2',
                    '200' => '#fecaca',
                    '300' => '#fca5a5',
                    '400' => '#f87171',
                    '500' => '#ef4444',
                    '600' => '#dc2626',
                    '700' => '#b91c1c',
                    '800' => '#991b1b',
                    '900' => '#7f1d1d',
                    '950' => '#450a0a',
                    'DEFAULT' => '#ef4444',
                ],
                'orange' => [
                    '50' => '#fff7ed',
                    '100' => '#ffedd5',
                    '200' => '#fed7aa',
                    '300' => '#fdba74',
                    '400' => '#fb923c',
                    '500' => '#f97316',
                    '600' => '#ea580c',
                    '700' => '#c2410c',
                    '800' => '#9a3412',
                    '900' => '#7c2d12',
                    '950' => '#431407',
                    'DEFAULT' => '#f97316',
                ],
                'amber' => [
                    '50' => '#fffbeb',
                    '100' => '#fef3c7',
                    '200' => '#fde68a',
                    '300' => '#fcd34d',
                    '400' => '#fbbf24',
                    '500' => '#f59e0b',
                    '600' => '#d97706',
                    '700' => '#b45309',
                    '800' => '#92400e',
                    '900' => '#78350f',
                    '950' => '#451a03',
                    'DEFAULT' => '#f59e0b',
                ],
                'yellow' => [
                    '50' => '#fefce8',
                    '100' => '#fef9c3',
                    '200' => '#fef08a',
                    '300' => '#fde047',
                    '400' => '#facc15',
                    '500' => '#eab308',
                    '600' => '#ca8a04',
                    '700' => '#a16207',
                    '800' => '#854d0e',
                    '900' => '#713f12',
                    '950' => '#422006',
                    'DEFAULT' => '#eab308',
                ],
                'lime' => [
                    '50' => '#f7fee7',
                    '100' => '#ecfccb',
                    '200' => '#d9f99d',
                    '300' => '#bef264',
                    '400' => '#a3e635',
                    '500' => '#84cc16',
                    '600' => '#65a30d',
                    '700' => '#4d7c0f',
                    '800' => '#3f6212',
                    '900' => '#365314',
                    '950' => '#1a2e05',
                    'DEFAULT' => '#84cc16',
                ],
                'green' => [
                    '50' => '#f0fdf4',
                    '100' => '#dcfce7',
                    '200' => '#bbf7d0',
                    '300' => '#86efac',
                    '400' => '#4ade80',
                    '500' => '#22c55e',
                    '600' => '#16a34a',
                    '700' => '#15803d',
                    '800' => '#166534',
                    '900' => '#14532d',
                    '950' => '#052e16',
                    'DEFAULT' => '#22c55e',
                ],
                'emerald' => [
                    '50' => '#ecfdf5',
                    '100' => '#d1fae5',
                    '200' => '#a7f3d0',
                    '300' => '#6ee7b7',
                    '400' => '#34d399',
                    '500' => '#10b981',
                    '600' => '#059669',
                    '700' => '#047857',
                    '800' => '#065f46',
                    '900' => '#064e3b',
                    '950' => '#022c22',
                    'DEFAULT' => '#10b981',
                ],
                'teal' => [
                    '50' => '#f0fdfa',
                    '100' => '#ccfbf1',
                    '200' => '#99f6e4',
                    '300' => '#5eead4',
                    '400' => '#2dd4bf',
                    '500' => '#14b8a6',
                    '600' => '#0d9488',
                    '700' => '#0f766e',
                    '800' => '#115e59',
                    '900' => '#134e4a',
                    '950' => '#042f2e',
                    'DEFAULT' => '#14b8a6',
                ],
                'cyan' => [
                    '50' => '#ecfeff',
                    '100' => '#cffafe',
                    '200' => '#a5f3fc',
                    '300' => '#67e8f9',
                    '400' => '#22d3ee',
                    '500' => '#06b6d4',
                    '600' => '#0891b2',
                    '700' => '#0e7490',
                    '800' => '#155e75',
                    '900' => '#164e63',
                    '950' => '#083344',
                    'DEFAULT' => '#06b6d4',
                ],
                'sky' => [
                    '50' => '#f0f9ff',
                    '100' => '#e0f2fe',
                    '200' => '#bae6fd',
                    '300' => '#7dd3fc',
                    '400' => '#38bdf8',
                    '500' => '#0ea5e9',
                    '600' => '#0284c7',
                    '700' => '#0369a1',
                    '800' => '#075985',
                    '900' => '#0c4a6e',
                    '950' => '#082f49',
                    'DEFAULT' => '#0ea5e9',
                ],
                'blue' => [
                    '50' => '#eff6ff',
                    '100' => '#dbeafe',
                    '200' => '#bfdbfe',
                    '300' => '#93c5fd',
                    '400' => '#60a5fa',
                    '500' => '#3b82f6',
                    '600' => '#2563eb',
                    '700' => '#1d4ed8',
                    '800' => '#1e40af',
                    '900' => '#1e3a8a',
                    '950' => '#172554',
                    'DEFAULT' => '#3b82f6',
                ],
                'indigo' => [
                    '50' => '#eef2ff',
                    '100' => '#e0e7ff',
                    '200' => '#c7d2fe',
                    '300' => '#a5b4fc',
                    '400' => '#818cf8',
                    '500' => '#6366f1',
                    '600' => '#4f46e5',
                    '700' => '#4338ca',
                    '800' => '#3730a3',
                    '900' => '#312e81',
                    '950' => '#1e1b4b',
                    'DEFAULT' => '#6366f1',
                ],
                'violet' => [
                    '50' => '#f5f3ff',
                    '100' => '#ede9fe',
                    '200' => '#ddd6fe',
                    '300' => '#c4b5fd',
                    '400' => '#a78bfa',
                    '500' => '#8b5cf6',
                    '600' => '#7c3aed',
                    '700' => '#6d28d9',
                    '800' => '#5b21b6',
                    '900' => '#4c1d95',
                    '950' => '#2e1065',
                    'DEFAULT' => '#8b5cf6',
                ],
                'purple' => [
                    '50' => '#faf5ff',
                    '100' => '#f3e8ff',
                    '200' => '#e9d5ff',
                    '300' => '#d8b4fe',
                    '400' => '#c084fc',
                    '500' => '#a855f7',
                    '600' => '#9333ea',
                    '700' => '#7e22ce',
                    '800' => '#6b21a8',
                    '900' => '#581c87',
                    '950' => '#3b0764',
                    'DEFAULT' => '#a855f7',
                ],
                'fuchsia' => [
                    '50' => '#fdf4ff',
                    '100' => '#fae8ff',
                    '200' => '#f5d0fe',
                    '300' => '#f0abfc',
                    '400' => '#e879f9',
                    '500' => '#d946ef',
                    '600' => '#c026d3',
                    '700' => '#a21caf',
                    '800' => '#86198f',
                    '900' => '#701a75',
                    '950' => '#4a044e',
                    'DEFAULT' => '#d946ef',
                ],
                'pink' => [
                    '50' => '#fdf2f8',
                    '100' => '#fce7f3',
                    '200' => '#fbcfe8',
                    '300' => '#f9a8d4',
                    '400' => '#f472b6',
                    '500' => '#ec4899',
                    '600' => '#db2777',
                    '700' => '#be185d',
                    '800' => '#9d174d',
                    '900' => '#831843',
                    '950' => '#500724',
                    'DEFAULT' => '#ec4899',
                ],
                'rose' => [
                    '50' => '#fff1f2',
                    '100' => '#ffe4e6',
                    '200' => '#fecdd3',
                    '300' => '#fda4af',
                    '400' => '#fb7185',
                    '500' => '#f43f5e',
                    '600' => '#e11d48',
                    '700' => '#be123c',
                    '800' => '#9f1239',
                    '900' => '#881337',
                    '950' => '#4c0519',
                    'DEFAULT' => '#f43f5e',
                ],
                // Base colors
                'white' => '#ffffff',
                'black' => '#000000',
                'transparent' => 'transparent',
            ],
            'fontSize' => [
                'xs' => ['12px', '16px'],
                'sm' => ['14px', '20px'],
                'base' => ['16px', '24px'],
                'lg' => ['18px', '28px'],
                'xl' => ['20px', '28px'],
                '2xl' => ['24px', '32px'],
                '3xl' => ['30px', '36px'],
                '4xl' => ['36px', '40px'],
                '5xl' => ['48px', '48px'],
                '6xl' => ['60px', '60px'],
                '7xl' => ['72px', '72px'],
                '8xl' => ['96px', '96px'],
                '9xl' => ['128px', '128px'],
            ],
            'fontFamily' => [
                'sans' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                'serif' => 'ui-serif, Georgia, Cambria, "Times New Roman", Times, serif',
                'mono' => 'ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
            ],
            'fontWeight' => [
                'thin' => '100',
                'extralight' => '200',
                'light' => '300',
                'normal' => '400',
                'medium' => '500',
                'semibold' => '600',
                'bold' => '700',
                'extrabold' => '800',
                'black' => '900',
            ],
            'lineHeight' => [
                '3' => '12px',
                '4' => '16px',
                '5' => '20px',
                '6' => '24px',
                '7' => '28px',
                '8' => '32px',
                '9' => '36px',
                '10' => '40px',
                'none' => '1',
                'tight' => '1.25',
                'snug' => '1.375',
                'normal' => '1.5',
                'relaxed' => '1.625',
                'loose' => '2',
            ],
            'letterSpacing' => [
                'tighter' => '-0.8px',
                'tight' => '-0.4px',
                'normal' => '0px',
                'wide' => '0.4px',
                'wider' => '0.8px',
                'widest' => '1.6px',
            ],
            'opacity' => [
                '0' => '0',
                '5' => '0.05',
                '10' => '0.1',
                '15' => '0.15',
                '20' => '0.2',
                '25' => '0.25',
                '30' => '0.3',
                '35' => '0.35',
                '40' => '0.4',
                '45' => '0.45',
                '50' => '0.5',
                '55' => '0.55',
                '60' => '0.6',
                '65' => '0.65',
                '70' => '0.7',
                '75' => '0.75',
                '80' => '0.8',
                '85' => '0.85',
                '90' => '0.9',
                '95' => '0.95',
                '100' => '1',
            ],
            'boxShadow' => [
                'sm' => '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'DEFAULT' => '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
                'md' => '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                'lg' => '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                'xl' => '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                '2xl' => '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                'none' => 'none',
            ],
            'borderWidth' => [
                '0' => '0px',
                'DEFAULT' => '1px',
                '2' => '2px',
                '4' => '4px',
                '8' => '8px',
            ],
            'borderRadius' => [
                'none' => '0px',
                'sm' => '2px',
                'DEFAULT' => '4px',
                'md' => '6px',
                'lg' => '8px',
                'xl' => '12px',
                '2xl' => '16px',
                '3xl' => '24px',
                'full' => '9999px',
            ],
            'size' => [
                '0' => '0px',
                'px' => '1px',
                '0.5' => '2px',
                '1' => '4px',
                '1.5' => '6px',
                '2' => '8px',
                '2.5' => '10px',
                '3' => '12px',
                '3.5' => '14px',
                '4' => '16px',
                '5' => '20px',
                '6' => '24px',
                '7' => '28px',
                '8' => '32px',
                '9' => '36px',
                '10' => '40px',
                '11' => '44px',
                '12' => '48px',
                '14' => '56px',
                '16' => '64px',
                '20' => '80px',
                '24' => '96px',
                '28' => '112px',
                '32' => '128px',
                '36' => '144px',
                '40' => '160px',
                '44' => '176px',
                '48' => '192px',
                '52' => '208px',
                '56' => '224px',
                '60' => '240px',
                '64' => '256px',
                '72' => '288px',
                '80' => '320px',
                '96' => '384px',
                'auto' => 'auto',
                '1/2' => '50%',
                '1/3' => '33.333333%',
                '2/3' => '66.666667%',
                '1/4' => '25%',
                '2/4' => '50%',
                '3/4' => '75%',
                '1/5' => '20%',
                '2/5' => '40%',
                '3/5' => '60%',
                '4/5' => '80%',
                '1/6' => '16.666667%',
                '2/6' => '33.333333%',
                '3/6' => '50%',
                '4/6' => '66.666667%',
                '5/6' => '83.333333%',

                'full' => '100%',
            ],
        ]);
    }

    /** @return array<Rule> */
    private function getBackgroundColorRules(): array
    {
        return [
            new Rule(
                pattern: '/^bg-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'background-color' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^bg-(?<color>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'background-color' => $theme->getFlattened('colors')[$matches['color']] ?? null,
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getTextUtilitiesRules(): array
    {
        return [
            new Rule(
                pattern: '/^text-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => $this->resolveArbitraryTextValue($matches['value']),
            ),
            new Rule(
                pattern: '/^text-(?<size>[a-z0-9-]+)\/(?<lineHeight>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveTextWithLineHeight(
                    $theme,
                    $matches['size'],
                    $matches['lineHeight']
                ),
            ),
            new Rule(
                pattern: '/^text-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveTextValue($theme, $matches['value'])
            ),
        ];
    }

    /** @return array<Rule> */
    private function getFontRules(): array
    {
        return [
            new Rule(
                pattern: '/^font-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'font-weight' => $matches['value'],
                ]),
            ),
            new Rule(
                pattern: '/^font-(?<value>[a-z]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveFontValue($theme, $matches['value'])
            ),
        ];
    }

    /** @return array<Rule> */
    private function getBoxShadowRules(): array
    {
        return [
            new Rule(
                pattern: '/^shadow-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'box-shadow' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^shadow-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'box-shadow' => $theme->getFlattened('boxShadow')[$matches['value']] ?? null,
                ]),
            ),

            new Rule(
                pattern: '/^shadow$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'box-shadow' => $theme->getFlattened('boxShadow')['DEFAULT'] ?? null,
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getOpacityRules(): array
    {
        return $this->createUtilityRules('opacity', 'opacity', 'opacity');
    }

    /** @return array<Rule> */
    private function getVerticalAlignRules(): array
    {
        return [
            new Rule(
                pattern: '/^align-(?<value>[a-z-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'vertical-align' => match ($matches['value']) {
                        'baseline', 'top', 'middle', 'bottom', 'text-top', 'text-bottom' => $matches['value'],
                        default => null,
                    },
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getDisplayRules(): array
    {
        return [
            new Rule(
                pattern: '/^(?<value>block|inline|inline-block|hidden)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'display' => match ($matches['value']) {
                        'block', 'inline', 'inline-block' => $matches['value'],
                        'hidden' => 'none',
                        default => null,
                    },
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getTextTransformRules(): array
    {
        return [
            new Rule(
                pattern: '/^(?<value>uppercase|lowercase|capitalize|normal-case)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'text-transform' => match ($matches['value']) {
                        'uppercase', 'lowercase', 'capitalize' => $matches['value'],
                        'normal-case' => 'none',
                        default => null,
                    },
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getLetterSpacingRules(): array
    {
        return $this->createUtilityRules('tracking', 'letter-spacing', 'letterSpacing');
    }

    /** @return array<Rule> */
    private function getTextDecorationRules(): array
    {
        return [
            new Rule(
                pattern: '/^(?<value>underline|line-through|no-underline)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'text-decoration' => match ($matches['value']) {
                        'underline', 'line-through' => $matches['value'],
                        'no-underline' => 'none',
                        default => null,
                    },
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getLineHeightRules(): array
    {
        return [
            new Rule(
                pattern: '/^leading-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'line-height' => $matches['value'],
                ]),
            ),
            new Rule(
                pattern: '/^leading-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveLineHeightValue($theme, $matches['value']),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getBorderRadiusRules(): array
    {
        return [
            ...$this->createBorderRadiusRules('tl', ['top-left']),
            ...$this->createBorderRadiusRules('tr', ['top-right']),
            ...$this->createBorderRadiusRules('br', ['bottom-right']),
            ...$this->createBorderRadiusRules('bl', ['bottom-left']),
            ...$this->createBorderRadiusRules('t', ['top-left', 'top-right']),
            ...$this->createBorderRadiusRules('r', ['top-right', 'bottom-right']),
            ...$this->createBorderRadiusRules('b', ['bottom-right', 'bottom-left']),
            ...$this->createBorderRadiusRules('l', ['top-left', 'bottom-left']),
            ...$this->createBorderRadiusRules('', ['top-left', 'top-right', 'bottom-right', 'bottom-left']),
        ];
    }

    /** @return array<Rule> */
    private function getBorderRules(): array
    {
        return [
            new Rule(
                pattern: '/^border-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => $this->resolveArbitraryBorderValue($matches['value'], 'border'),
            ),

            new Rule(
                pattern: '/^border$/',
                style: new Style([
                    'border-width' => '1px',
                    'border-style' => 'solid',
                ]),
            ),

            new Rule(
                pattern: '/^border-x$/',
                style: new Style([
                    'border-left-width' => '1px',
                    'border-right-width' => '1px',
                    'border-left-style' => 'solid',
                    'border-right-style' => 'solid',
                ]),
            ),

            new Rule(
                pattern: '/^border-y$/',
                style: new Style([
                    'border-top-width' => '1px',
                    'border-bottom-width' => '1px',
                    'border-top-style' => 'solid',
                    'border-bottom-style' => 'solid',
                ]),
            ),

            new Rule(
                pattern: '/^border-t$/',
                style: new Style([
                    'border-top-width' => '1px',
                    'border-top-style' => 'solid',
                ]),
            ),

            new Rule(
                pattern: '/^border-r$/',
                style: new Style([
                    'border-right-width' => '1px',
                    'border-right-style' => 'solid',
                ]),
            ),

            new Rule(
                pattern: '/^border-b$/',
                style: new Style([
                    'border-bottom-width' => '1px',
                    'border-bottom-style' => 'solid',
                ]),
            ),

            new Rule(
                pattern: '/^border-l$/',
                style: new Style([
                    'border-left-width' => '1px',
                    'border-left-style' => 'solid',
                ]),
            ),

            new Rule(
                pattern: '/^border-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveBorderValue($theme, $matches['value'], 'border')
            ),

            new Rule(
                pattern: '/^border-t-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => $this->resolveArbitraryBorderValue($matches['value'], 'border-top'),
            ),

            new Rule(
                pattern: '/^border-t-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveBorderValue($theme, $matches['value'], 'border-top')
            ),

            new Rule(
                pattern: '/^border-r-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => $this->resolveArbitraryBorderValue($matches['value'], 'border-right'),
            ),

            new Rule(
                pattern: '/^border-r-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveBorderValue($theme, $matches['value'], 'border-right')
            ),

            new Rule(
                pattern: '/^border-b-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => $this->resolveArbitraryBorderValue($matches['value'], 'border-bottom'),
            ),

            new Rule(
                pattern: '/^border-b-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveBorderValue($theme, $matches['value'], 'border-bottom')
            ),

            new Rule(
                pattern: '/^border-l-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => $this->resolveArbitraryBorderValue($matches['value'], 'border-left'),
            ),

            new Rule(
                pattern: '/^border-l-(?<value>[a-z0-9-]+)$/',
                style: fn (Theme $theme, array $matches) => $this->resolveBorderValue($theme, $matches['value'], 'border-left')
            ),
        ];
    }

    /** @return array<Rule> */
    private function getSizeRules(): array
    {
        return [
            new Rule(
                pattern: '/^w-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'width' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^w-(?<value>[a-z0-9\/-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'width' => $this->resolveSizeValue($theme, $matches['value']),
                ]),
            ),

            new Rule(
                pattern: '/^h-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'height' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^h-(?<value>[a-z0-9\/-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'height' => $this->resolveSizeValue($theme, $matches['value']),
                ]),
            ),

            new Rule(
                pattern: '/^max-w-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'max-width' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^max-w-(?<value>[a-z0-9\/-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'max-width' => $this->resolveSizeValue($theme, $matches['value']),
                ]),
            ),

            new Rule(
                pattern: '/^min-w-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'min-width' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^min-w-(?<value>[a-z0-9\/-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'min-width' => $this->resolveSizeValue($theme, $matches['value']),
                ]),
            ),

            new Rule(
                pattern: '/^max-h-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'max-height' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^max-h-(?<value>[a-z0-9\/-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'max-height' => $this->resolveSizeValue($theme, $matches['value']),
                ]),
            ),

            new Rule(
                pattern: '/^min-h-\[(?<value>[^\]]+)\]$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'min-height' => $matches['value'],
                ]),
            ),

            new Rule(
                pattern: '/^min-h-(?<value>[a-z0-9\/-]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'min-height' => $this->resolveSizeValue($theme, $matches['value']),
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function getPaddingRules(): array
    {
        return [
            ...$this->createSpacingRules('p', ['padding']),
            ...$this->createSpacingRules('px', ['padding-left', 'padding-right']),
            ...$this->createSpacingRules('py', ['padding-top', 'padding-bottom']),
            ...$this->createSpacingRules('pt', ['padding-top']),
            ...$this->createSpacingRules('pr', ['padding-right']),
            ...$this->createSpacingRules('pb', ['padding-bottom']),
            ...$this->createSpacingRules('pl', ['padding-left']),
        ];
    }

    /** @return array<Rule> */
    private function getMarginRules(): array
    {
        return [
            ...$this->createSpacingRules('m', ['margin']),
            ...$this->createSpacingRules('mx', ['margin-left', 'margin-right']),
            ...$this->createSpacingRules('my', ['margin-top', 'margin-bottom']),
            ...$this->createSpacingRules('mt', ['margin-top']),
            ...$this->createSpacingRules('mr', ['margin-right']),
            ...$this->createSpacingRules('mb', ['margin-bottom']),
            ...$this->createSpacingRules('ml', ['margin-left']),
            new Rule(
                pattern: '/^mx-auto$/',
                style: new Style([
                    'margin-left' => 'auto',
                    'margin-right' => 'auto',
                ]),
            ),
        ];
    }

    /** @return array<Rule> */
    private function createUtilityRules(
        string $prefix,
        string $cssProperty,
        ?string $themeKey = null
    ): array {
        $rules = [
            new Rule(
                pattern: "/^{$prefix}-\[(?<value>[^\]]+)\]$/",
                style: fn (Theme $theme, array $matches) => new Style([
                    $cssProperty => $matches['value'],
                ]),
            ),
        ];

        if ($themeKey !== null) {
            $rules[] = new Rule(
                pattern: "/^{$prefix}-(?<value>[a-z0-9-]+)$/",
                style: fn (Theme $theme, array $matches) => new Style([
                    $cssProperty => $theme->getFlattened($themeKey)[$matches['value']] ?? null,
                ]),
            );
        }

        return $rules;
    }

    /**
     * @param  array<int, string>  $cssProperties
     * @return array<int, Rule>
     */
    private function createSpacingRules(
        string $prefix,
        array $cssProperties,
        int $multiplier = 4
    ): array {
        return [
            new Rule(
                pattern: "/^{$prefix}-\[(?<value>[^\]]+)\]$/",
                style: fn (Theme $theme, array $matches) => new Style(
                    array_fill_keys($cssProperties, $matches['value'])
                ),
            ),
            new Rule(
                pattern: "/^{$prefix}-(?<value>[a-z0-9]+)$/",
                style: function (Theme $theme, array $matches) use ($cssProperties, $multiplier) {
                    if (! is_numeric($matches['value'])) {
                        return null;
                    }

                    $value = $matches['value'] == 0 ? '0px' : ($matches['value'] * $multiplier).'px';

                    return new Style(array_fill_keys($cssProperties, $value));
                },
            ),
        ];
    }

    /**
     * @param  array<int, string>  $corners
     * @return array<int, Rule>
     */
    private function createBorderRadiusRules(
        string $suffix,
        array $corners
    ): array {
        $prefix = $suffix ? "rounded-{$suffix}" : 'rounded';
        $cssProperties = array_map(fn (string $corner) => "border-{$corner}-radius", $corners);

        return [
            new Rule(
                pattern: "/^{$prefix}$/",
                style: fn (Theme $theme, array $matches) => new Style(
                    array_fill_keys($cssProperties, $theme->getFlattened('borderRadius')['DEFAULT'] ?? null)
                ),
            ),
            new Rule(
                pattern: "/^{$prefix}-\[(?<value>[^\]]+)\]$/",
                style: fn (Theme $theme, array $matches) => new Style(
                    array_fill_keys($cssProperties, $matches['value'])
                ),
            ),
            new Rule(
                pattern: "/^{$prefix}-(?<value>[a-z0-9-]+)$/",
                style: fn (Theme $theme, array $matches) => new Style(
                    array_fill_keys(
                        $cssProperties,
                        $theme->getFlattened('borderRadius')[$matches['value']] ?? null
                    )
                ),
            ),
        ];
    }

    private function resolveTextValue(Theme $theme, string $value): ?Style
    {
        $textAlign = match ($value) {
            'left', 'center', 'right', 'justify' => $value,
            default => null,
        };

        if ($textAlign !== null) {
            return new Style(['text-align' => $textAlign]);
        }

        $fontSizeValue = $theme->getFlattened('fontSize')[$value] ?? null;

        if ($fontSizeValue !== null) {
            if (is_array($fontSizeValue)) {
                return new Style([
                    'font-size' => $fontSizeValue[0],
                    'line-height' => $fontSizeValue[1],
                ]);
            }

            return new Style(['font-size' => $fontSizeValue]);
        }

        $color = $theme->getFlattened('colors')[$value] ?? null;

        if ($color === null) {
            return null;
        }

        return new Style(['color' => $color]);
    }

    private function resolveTextWithLineHeight(Theme $theme, string $size, string $lineHeight): ?Style
    {
        $fontSizeValue = $theme->getFlattened('fontSize')[$size] ?? null;

        if ($fontSizeValue === null) {
            return null;
        }

        $fontSize = is_array($fontSizeValue) ? $fontSizeValue[0] : $fontSizeValue;
        $resolvedLineHeight = $this->resolveLineHeightOnly($theme, $lineHeight);

        if ($resolvedLineHeight === null) {
            return new Style(['font-size' => $fontSize]);
        }

        return new Style([
            'font-size' => $fontSize,
            'line-height' => $resolvedLineHeight,
        ]);
    }

    private function resolveFontValue(Theme $theme, string $value): ?Style
    {
        $fontFamily = $theme->getFlattened('fontFamily')[$value] ?? null;

        if ($fontFamily !== null) {
            return new Style(['font-family' => $fontFamily]);
        }

        $fontWeight = $theme->getFlattened('fontWeight')[$value] ?? null;

        if ($fontWeight === null) {
            return null;
        }

        return new Style(['font-weight' => $fontWeight]);
    }

    private function resolveBorderValue(Theme $theme, string $value, string $cssProperty): ?Style
    {
        if (is_numeric($value)) {
            return new Style(["{$cssProperty}-width" => $value.'px']);
        }

        if ($value === 'DEFAULT') {
            return new Style(["{$cssProperty}-width" => $theme->getFlattened('borderWidth')['DEFAULT']]);
        }

        if (in_array($value, ['solid', 'dashed', 'dotted', 'none'], true)) {
            return new Style(["{$cssProperty}-style" => $value]);
        }

        $color = $theme->getFlattened('colors')[$value] ?? null;

        if ($color === null) {
            return null;
        }

        return new Style(["{$cssProperty}-color" => $color]);
    }

    private function resolveSizeValue(Theme $theme, string $value): ?string
    {
        $themeValue = $theme->getFlattened('size')[$value] ?? null;

        if ($themeValue !== null) {
            return $themeValue;
        }

        if (! is_numeric($value)) {
            return null;
        }

        return $value === '0' ? '0px' : ($value * 4).'px';
    }

    private function resolveLineHeightOnly(Theme $theme, string $value): ?string
    {
        $themeValue = $theme->getFlattened('lineHeight')[$value] ?? null;

        if ($themeValue !== null) {
            return $themeValue;
        }

        if (! is_numeric($value)) {
            return null;
        }

        return $value === '0' ? '0px' : ($value * 4).'px';
    }

    private function resolveLineHeightValue(Theme $theme, string $value): ?Style
    {
        $lineHeight = $this->resolveLineHeightOnly($theme, $value);

        if ($lineHeight === null) {
            return null;
        }

        return new Style(['line-height' => $lineHeight]);
    }

    private function isColor(string $value): bool
    {
        return str_starts_with($value, '#') ||
            str_starts_with($value, 'rgb') ||
            str_starts_with($value, 'hsl');
    }

    private function resolveArbitraryTextValue(string $value): Style
    {
        if ($this->isColor($value)) {
            return new Style(['color' => $value]);
        }

        if (preg_match('/\d+(px|em|rem|%|pt|vh|vw|ch|ex)$/', $value)) {
            return new Style(['font-size' => $value]);
        }

        return new Style(['color' => $value]);
    }

    private function resolveArbitraryBorderValue(string $value, string $cssProperty): Style
    {
        if ($this->isColor($value)) {
            return new Style(["{$cssProperty}-color" => $value]);
        }

        if (preg_match('/^\d+(px|em|rem|pt)?$/', $value)) {
            return new Style(["{$cssProperty}-width" => $value]);
        }

        return new Style([$cssProperty => $value]);
    }
}
